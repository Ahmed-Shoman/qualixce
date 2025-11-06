<?php

namespace App\Filament\Resources;

use \Str;
use App\Filament\Resources\ArticleResource\Pages;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationLabel = 'Articles';
    protected static ?string $modelLabel = 'Article';
    protected static ?string $pluralLabel = 'Articles';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('Article Information'))
                    ->schema([
                        Tabs::make('Translations')
                            ->tabs([
                                Tabs\Tab::make('English')
                                    ->schema([
                                        TextInput::make('title.en')
                                            ->label('Title (EN)')
                                            ->required()
                                            ->reactive()
                                            ->afterStateUpdated(fn ($state, callable $set) =>
                                                $set('slug.en', Str::slug($state))
                                            ),
                                        TextInput::make('slug.en')
                                            ->label('Slug (EN)')
                                            ->placeholder('auto-generated or custom')
                                            ->unique(table: 'articles', column: 'slug->en', ignoreRecord: true)
                                            ->helperText('Used in the article URL, must be unique.'),
                                        TextInput::make('subtitle.en')->label('Subtitle (EN)'),
                                        Textarea::make('content.en')->label('Content (EN)')->rows(5),
                                        TextInput::make('image_alt.en')->label('Image Alt (EN)'),
                                        TextInput::make('writer.en')->label('Writer (EN)')->required(),
                                        TextInput::make('category.en')->label('Category (EN)')->required(),
                                    ]),
                                Tabs\Tab::make('Arabic')
                                    ->schema([
                                        TextInput::make('title.ar')
                                            ->label('Title (AR)')
                                            ->required()
                                            ->reactive()
                                            ->afterStateUpdated(fn ($state, callable $set) =>
                                                $set('slug.ar', Str::slug($state, '-', 'ar'))
                                            )
                                            ->extraAttributes(['dir' => 'rtl']),
                                        TextInput::make('slug.ar')
                                            ->label('Slug (AR)')
                                            ->placeholder('auto-generated or custom')
                                            ->unique(table: 'articles', column: 'slug->ar', ignoreRecord: true)
                                            ->helperText('Used in the article URL, must be unique.')
                                            ->extraAttributes(['dir' => 'rtl']),
                                        TextInput::make('subtitle.ar')->label('Subtitle (AR)')->extraAttributes(['dir' => 'rtl']),
                                        Textarea::make('content.ar')->label('Content (AR)')->rows(5)->extraAttributes(['dir' => 'rtl']),
                                        TextInput::make('image_alt.ar')->label('Image Alt (AR)')->extraAttributes(['dir' => 'rtl']),
                                        TextInput::make('writer.ar')->label('Writer (AR)')->required()->extraAttributes(['dir' => 'rtl']),
                                        TextInput::make('category.ar')->label('Category (AR)')->required()->extraAttributes(['dir' => 'rtl']),
                                    ]),
                            ]),
                        FileUpload::make('image')
                            ->directory('articles')
                            ->image()
                            ->imageEditor()
                            ->required()
                            ->maxSize(2048),
                        Toggle::make('is_active')->label(__('Visible on website'))->default(true),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Title (EN)')
                    ->formatStateUsing(fn($record) => $record->getTranslation('title', 'en'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('writer')
                    ->label('Writer')
                    ->formatStateUsing(fn($record) => $record->getTranslation('writer', 'en'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category')
                    ->label('Category')
                    ->formatStateUsing(fn($record) => $record->getTranslation('category', 'en'))
                    ->badge()
                    ->color('primary')
                    ->sortable(),
                TextColumn::make('slug')
                    ->label('Slug')
                    ->copyable()
                    ->copyMessage('Slug copied!')
                    ->limit(30),
                IconColumn::make('is_active')
                    ->label('Visible')
                    ->boolean()
                    ->sortable(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
                ViewAction::make(),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
