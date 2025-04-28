<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\Actions\UnbanAction;
use App\Filament\Resources\Actions\UnbanBulkAction;
use App\Filament\Resources\BanResource\Pages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Mchev\Banhammer\Models\Ban;

class BanResource extends Resource
{
    protected static ?string $model = Ban::class;

    protected static ?string $navigationIcon = 'heroicon-o-shield-exclamation';

    public static function getNavigationSort(): ?int
    {
        return 0;
    }

    public static function getNavigationLabel(): string
    {
        return __('menu.nav_item.ban');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('menu.nav_group.security');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('bannable_type')
                    ->maxLength(255),
                Forms\Components\TextInput::make('bannable_id'),
                Forms\Components\TextInput::make('created_by_type')
                    ->maxLength(255),
                Forms\Components\TextInput::make('created_by_id'),
                Forms\Components\TextInput::make('ip')
                    ->maxLength(45),
                Forms\Components\DateTimePicker::make('expired_at'),
                Forms\Components\KeyValue::make('metas')
                    ->label('Metas')
                    ->keyLabel('Key')
                    ->valueLabel('Value')
                    ->nullable()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('comment')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('bannable_type'),
                Tables\Columns\TextColumn::make('bannable_id'),
                Tables\Columns\TextColumn::make('created_by_type'),
                Tables\Columns\TextColumn::make('created_by_id'),
                Tables\Columns\TextColumn::make('ip')
                    ->searchable(),
                Tables\Columns\TextColumn::make('expired_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('comment'),
            ])
            ->filters([
                //
            ])
            ->actions([
                UnbanAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    UnbanBulkAction::make(),
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
            'index' => Pages\ListBans::route('/'),
            'view' => Pages\ViewBan::route('/{record}'),
        ];
    }
}
