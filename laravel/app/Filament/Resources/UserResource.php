<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Support\Facades\Auth;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nama')
                    ->required(),

                TextInput::make('email')
                    ->email()
                    ->label('Email')
                    ->required(),

                TextInput::make('password')
                    ->label('Kata Sandi')
                    ->password()
                    // ->revealable() // Memungkinkan admin untuk melihat password
                    ->dehydrateStateUsing(fn($state) => !empty($state) ? bcrypt($state) : null) // Enkripsi jika diisi
                    ->dehydrated(fn($state) => filled($state)) // Hanya update jika diisi
                    ->required(fn($record) => $record === null) // Wajib saat user baru dibuat
                    ->visible(fn() => auth()->user()->role === 'admin'), // Hanya admin yang bisa melihat password

                Select::make('role')
                    ->label('Peran')
                    ->options([
                        'admin' => 'Admin',
                        'operator' => 'Operator',
                        'user' => 'User',
                    ])
                    ->default('user')
                    ->visible(fn() => auth()->user()->role === 'admin') // Hanya admin yang bisa mengubah role
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('role')
                    ->label('Peran')
                    ->sortable()
                    ->color(fn($state) => match ($state) {
                        'admin' => 'danger',
                        'operator' => 'warning',
                        'user' => 'success',
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role')
                    ->options([
                        'admin' => 'Admin',
                        'operator' => 'Operator',
                        'user' => 'User',
                    ])
                    ->label('Filter Peran'),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make()->visible(fn() => auth()->user()->role === 'admin'), // Hanya admin yang bisa edit
                DeleteAction::make()->visible(fn() => auth()->user()->role === 'admin'), // Hanya admin yang bisa hapus
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()->visible(fn() => auth()->user()->role === 'admin'), // Hanya admin yang bisa bulk delete
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
