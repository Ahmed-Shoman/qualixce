<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Filament\Resources\ArticleResource;
use App\Models\Article;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\CreateAction;

class ListArticles extends ListRecords
{
    protected static string $resource = ArticleResource::class;

    public function mount(): void
    {
        parent::mount();

        // ✅ If no articles exist → redirect to create page
        if (Article::count() === 0) {
            $this->redirect(ArticleResource::getUrl('create'));
        }
    }

    protected function getHeaderActions(): array
    {
        // ✅ Show Create button always (change if you want limit)
        return [
            CreateAction::make()->label(__('Add New Article')),
        ];
    }
}
