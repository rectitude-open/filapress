<?php

declare(strict_types=1);

namespace App\Filament\Clusters\NewsCluster\Resources;

use App\Filament\Clusters\NewsCluster;
use App\Filament\Clusters\NewsCluster\Resources\NewsTagResource\Pages;
use App\Models\Tag;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class NewsTagResource extends Resource
{
    protected static ?string $model = Tag::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 3;

    protected static ?string $cluster = NewsCluster::class;

    public static function getEloquentQuery(): Builder
    {
        /** @phpstan-ignore-next-line */
        return parent::getEloquentQuery()->queryWith('news')->withCount('news');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                KeyValue::make('name')
                    ->label(__('Name'))
                    ->required(),
                KeyValue::make('slug')
                    ->label(__('Slug'))
                    ->required(),
                TextInput::make('order_column')
                    ->label(__('Weight'))
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('Name'))
                    ->searchable(),
                TextColumn::make('slug')
                    ->label(__('Slug'))
                    ->searchable(),
                TextColumn::make('order_column')
                    ->label(__('Weight'))
                    ->searchable(),
                TextColumn::make('news_count')
                    ->label(__('Count'))
                    ->sortable(),
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
            'index' => Pages\ListNewsTags::route('/'),
            'edit' => Pages\EditNewsTag::route('/{record}/edit'),
        ];
    }
}
