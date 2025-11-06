<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\Action;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationLabel = 'Articles';
    protected static ?string $modelLabel = 'Article';
    protected static ?string $pluralLabel = 'Articles';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make(__('Article Information'))
                ->schema([
                    Tabs::make('Translations')
                        ->tabs([
                            Tabs\Tab::make('English')->schema([
                                TextInput::make('title.en')
                                    ->label('Title (EN)')
                                    ->required(),
                                TextInput::make('subtitle.en')
                                    ->label('Subtitle (EN)'),
                                Textarea::make('content.en')
                                    ->label('Content (EN)')
                                    ->rows(5),
                                TextInput::make('image_alt.en')
                                    ->label('Image Alt (EN)'),
                            ]),
                            Tabs\Tab::make('Arabic')->schema([
                                TextInput::make('title.ar')
                                    ->label('Title (AR)')
                                    ->required()
                                    ->extraAttributes(['dir' => 'rtl']),
                                TextInput::make('subtitle.ar')
                                    ->label('Subtitle (AR)')
                                    ->extraAttributes(['dir' => 'rtl']),
                                Textarea::make('content.ar')
                                    ->label('Content (AR)')
                                    ->rows(5)
                                    ->extraAttributes(['dir' => 'rtl']),
                                TextInput::make('image_alt.ar')
                                    ->label('Image Alt (AR)')
                                    ->extraAttributes(['dir' => 'rtl']),


                        ]),

                          FileUpload::make('image')
                        ->label(__('Article Image'))
                        ->directory('articles')
                        ->image()
                        ->imageEditor()
                        ->maxSize(2048),
                            ]),
                    TextInput::make('writer')
                        ->label(__('Writer'))
                        ->placeholder('Enter the author name')
                        ->required(),

                    TextInput::make('category')
                        ->label(__('Category'))
                        ->placeholder('Enter article category')
                        ->required(),

                    TextInput::make('slug')
                        ->label(__('Slug'))
                        ->placeholder('auto-generated or custom')
                        ->unique(ignoreRecord: true)
                        ->helperText('Used in the article URL, must be unique.'),

                    Toggle::make('is_active')
                        ->label(__('Visible on website'))
                        ->default(true),
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
                    ->sortable()
                    ->searchable(),

                TextColumn::make('category')
                    ->label('Category')
                    ->sortable()
                    ->badge()
                    ->color('primary'),

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
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
                Action::make('preview')
                    ->label('View on Website')
                    ->icon('heroicon-o-globe-alt')
                    ->color('info')
                    ->url(fn($record) => route('article.show', $record->slug))
                    ->openUrlInNewTab(),
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
