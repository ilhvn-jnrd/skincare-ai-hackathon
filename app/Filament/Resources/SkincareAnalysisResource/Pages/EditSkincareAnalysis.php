<?php

namespace App\Filament\Resources\SkincareAnalysisResource\Pages;

use App\Filament\Resources\SkincareAnalysisResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSkincareAnalysis extends EditRecord
{
    protected static string $resource = SkincareAnalysisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
