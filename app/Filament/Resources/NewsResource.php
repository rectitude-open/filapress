<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Filament\Resources\NewsResource\RelationManagers;
use App\Models\News;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Number;
use RalphJSmit\Filament\Components\Forms\Sidebar;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\ToggleButtons;
use TomatoPHP\FilamentMediaManager\Form\MediaManagerInput;
use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(['sm' => 3])->schema([
                    Grid::make()->schema([
                        TextInput::make('title')
                            ->label(__('News Title'))
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        TinyEditor::make('content')
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsVisibility('public')
                            ->fileAttachmentsDirectory('uploads')
                            ->columnSpan('full')
                    ])->columnSpan(['md' => 2]),
                    Grid::make()->schema([
                        Section::make(__('Featured Image'))
                            ->schema([
                                MediaManagerInput::make('featured_image')
                                    ->defaultItems(0)
                                    ->hiddenLabel()
                                    ->maxItems(1)
                                    ->disk('public')
                                    ->orderable(false)
                                    ->schema([])
                                    ->nullable(),
                            ]),
                        Section::make(__('Meta'))
                            ->schema([
                                TextInput::make('slug')
                                    ->label(__('Slug'))
                                    ->maxLength(255)
                                    ->columnSpanFull(),
                                Textarea::make('summary')
                                    ->label(__('Summary'))
                                    ->default('')
                                    ->maxLength(255)
                                    ->columnSpanFull()
                                    ->dehydrateStateUsing(fn ($state) => $state ?? ''),
                                TextInput::make('weight')
                                    ->label(__('Weight'))
                                    ->default(0)
                                    ->numeric()
                                    ->step(1)
                                    ->maxLength(255)
                                    ->columnSpanFull(),
                                ToggleButtons::make('status')
                                    ->options([
                                        1 => 'Active',
                                        2 => 'Suspended',
                                    ])
                                    ->default(1)
                                    ->colors([
                                        1 => 'success',
                                        2 => 'warning',
                                    ])
                                    ->icons([
                                        1 => 'heroicon-o-check-circle',
                                        2 => 'heroicon-o-x-circle',
                                    ])
                                    ->inline()
                            ])
                            ->collapsible(),
                    ])->columnSpan(['md' => 1]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label(__('Title'))
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                IconColumn::make('status')
                    ->icon(fn ($state): string => match ($state) {
                        1 => 'heroicon-o-check-circle',
                        2 => 'heroicon-o-x-circle',
                    })
                    ->color(fn ($state): string => match ($state) {
                        1 => 'success',
                        2 => 'danger',
                    }),
                TextColumn::make('created_at')
                    ->label(__('Created At'))
                    ->dateTime('Y-m-d H:i:s')
                    ->sortable(),

            ])->filters([
                //
            ])->actions([
                //
            ])->bulkActions([
                //
            ])->headerActions([
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
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}
