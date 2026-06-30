<?php

namespace App\Filament\Resources\SkincareAnalysisResource\Pages;

use App\Filament\Resources\SkincareAnalysisResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSkincareAnalyses extends ListRecords
{
    protected static string $resource = SkincareAnalysisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
