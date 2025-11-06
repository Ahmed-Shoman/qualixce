<?php

namespace App\Filament\Resources\TestimonialResource\Pages;

use App\Filament\Resources\TestimonialResource;
use App\Models\Testimonial;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\CreateAction;

class ListTestimonials extends ListRecords
{
    protected static string $resource = TestimonialResource::class;

    public function mount(): void
    {
        parent::mount();

        // ✅ لو مفيش أي testimonial record → روح على create
        if (Testimonial::count() === 0) {
            $this->redirect(TestimonialResource::getUrl('create'));
        }
    }

    protected function getHeaderActions(): array
    {
        // ✅ لو فيه record واحد على الأقل → اخفي زر Create
        if (Testimonial::count() >= 1) {
            return [];
        }

        // ✅ غير كده اعرض زرار الإضافة
        return [
            CreateAction::make()->label(__('Add Testimonial Section')),
        ];
    }
}