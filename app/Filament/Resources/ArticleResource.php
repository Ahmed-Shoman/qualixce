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
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\ViewAction;

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
                                TextInput::make('title.en')->label('Title (EN)')->required(),
                                TextInput::make('subtitle.en')->label('Subtitle (EN)'),
                                Textarea::make('content.en')->label('Content (EN)')->rows(5),
                                TextInput::make('image_alt.en')->label('Image Alt (EN)'),
                            ]),
                            Tabs\Tab::make('Arabic')->schema([
                                TextInput::make('title.ar')->label('Title (AR)')->required()->extraAttributes(['dir' => 'rtl']),
                                TextInput::make('subtitle.ar')->label('Subtitle (AR)')->extraAttributes(['dir' => 'rtl']),
                                Textarea::make('content.ar')->label('Content (AR)')->rows(5)->extraAttributes(['dir' => 'rtl']),
                                TextInput::make('image_alt.ar')->label('Image Alt (AR)')->extraAttributes(['dir' => 'rtl']),
                            ]),
                        ]),
                    FileUpload::make('image')
                        ->label(__('Article Image'))
                        ->directory('articles')
                        ->image()
                        ->imageEditor()
                        ->maxSize(2048),
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

                TextColumn::make('title')
                    ->label('Title (AR)')
                    ->formatStateUsing(fn($record) => $record->getTranslation('title', 'ar'))
                    ->color('gray'),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
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