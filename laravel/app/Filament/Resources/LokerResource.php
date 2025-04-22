<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Loker;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;
use App\Filament\Resources\LokerResource\Pages;

class LokerResource extends Resource
{
    protected static ?string $model = Loker::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Forms\Components\TextInput::make('judul')
                        ->label('judul')
                        ->required(),
                    Forms\Components\FileUpload::make('gambar')
                        ->label('Gambar Desain Open Lowongan Kerja  (JPG,PNG,SVG,JPeG)')
                        ->required()
                        ->image()
                        ->disk('public'),
                    Forms\Components\RichEditor::make('detail')
                        ->label('Detail Lowongan')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\RichEditor::make('detail_s')
                        ->label('Detail Singkat')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('max_pelamar')
                        ->label('Max Pelamar')
                        ->required()
                        ->numeric(),
                    Forms\Components\DatePicker::make('tanggal_mulai')
                        ->label('Tanggal Awal Penerimaan')
                        ->required(),
                    Forms\Components\DatePicker::make('tanggal_selesai')
                        ->label('Tanggal Akhir Penerimaan')
                        ->required()
                        ->afterStateUpdated(function ($state, callable $get, callable $set) {
                            if ($state < $get('tanggal_mulai')) {
                                $set('tanggal_selesai', null); // Reset nilai tanggal_selesai
                            }
                        })
                        ->rules([
                            function (callable $get) {
                                return function (string $attribute, $value, $fail) use ($get) {
                                    if ($value < $get('tanggal_mulai')) {
                                        $fail('Tanggal Akhir Penerimaan harus lebih besar atau sama dengan Tanggal Awal Penerimaan.');
                                    }
                                };
                            },
                        ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('detail')
                    ->label('Detail Lowongan')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('gambar')
                    ->label('Gambar Desain')
                    ->searchable(),
                Tables\Columns\TextColumn::make('max_pelamar')
                    ->label('Max Pelamar')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal_mulai')
                    ->label('Tanggal Awal')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_selesai')
                    ->label('Tanggal Akhir')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()->after(
                    function (Collection $records) {
                        foreach ($records as $record) {
                            if ($record->image) {
                                Storage::disk('public')->delete($record->image);
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
            'index' => Pages\ListLokers::route('/'),
            'create' => Pages\CreateLoker::route('/create'),
            'edit' => Pages\EditLoker::route('/{record}/edit'),
        ];
    }
}
