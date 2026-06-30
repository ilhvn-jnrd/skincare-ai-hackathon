<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SkincareAnalysisResource\Pages;
use App\Filament\Resources\SkincareAnalysisResource\RelationManagers;
use App\Models\SkincareAnalysis;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SkincareAnalysisResource extends Resource
{
    protected static ?string $model = SkincareAnalysis::class;

    protected static ?string $navigationIcon = 'heroicon-o-beaker';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\Textarea::make('product_names')
                    ->label('Daftar Produk / Kandungan Skincare')
                    ->placeholder('Ketik produk yang dipakai bersamaan, misalnya: Sabun CeraVe, Sunscreen Azarine, Salicylic Acid...')
                    ->required()
                    ->columnSpanFull(),
                \Filament\Forms\Components\Textarea::make('ai_response')
                    ->label('Hasil Analisis Dermatologis (AI)')
                    ->disabled()
                    ->columnSpanFull()
                    ->rows(8),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSkincareAnalyses::route('/'),
            'create' => Pages\CreateSkincareAnalysis::route('/create'),
            'edit' => Pages\EditSkincareAnalysis::route('/{record}/edit'),
        ];
    }
}
