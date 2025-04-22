<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RelasiResource\Pages;
use App\Filament\Resources\RelasiResource\RelationManagers;
use App\Models\Relasi;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\Card;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Collection;

class RelasiResource extends Resource
{
    protected static ?string $model = Relasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image_p')
                    ->label('Logo Perusahaan')
                    ->image() // Hanya menerima file gambar
                    ->required(),

                Forms\Components\TextInput::make('nama_p')
                    ->label('Nama Perusahaan')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('detail_singkat')
                    ->label('Detail Singkat Perusahaan')
                    ->required(),

                Forms\Components\RichEditor::make('detail_lengkap')
                    ->label('Detail Lengkap Perusahaan')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_p')
                    ->label('Logo')
                    ->size(50), // Ukuran gambar

                Tables\Columns\TextColumn::make('nama_p')
                    ->label('Nama Perusahaan')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('detail_singkat')
                    ->label('Detail Singkat')
                    ->limit(50), // Batas panjang teks

                Tables\Columns\TextColumn::make('detail_lengkap')
                    ->label('Detail lengkap')
                    ->limit(50),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Dibuat')
                    ->date('d M Y'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()->after(
                    function (Collection $records) {
                        foreach ($records as $key => $value) {
                            if ($value->thumbnail) {
                                Storage::disk('public')->delete($value->thumbnail);
                            }
                        }
                    }
                ),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()->after(
                    function (Collection $records) {
                        foreach ($records as $key => $value) {
                            if ($value->thumbnail) {
                                Storage::disk('public')->delete($value->thumbnail);
                            }
                        }
                    }

                ),
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
            'index' => Pages\ListRelasis::route('/'),
            'create' => Pages\CreateRelasi::route('/create'),
            'edit' => Pages\EditRelasi::route('/{record}/edit'),
        ];
    }
}
