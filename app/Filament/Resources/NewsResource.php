<?php

namespace App\Filament\Resources;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use App\Filament\Resources\NewsResource\Pages;
use App\Models\News;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use TomatoPHP\FilamentMediaManager\Form\MediaManagerInput;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = -1;

    public static function getNavigationGroup(): ?string
    {
        return __('menu.nav_group.content');
    }

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
                            ->columnSpan('full'),
                    ])->columnSpan(['xl' => 2]),
                    Grid::make()->schema([
                        Section::make(__('Featured Image'))
                            ->compact()
                            ->schema([
                                MediaManagerInput::make('featured_image')
                                    ->defaultItems(0)
                                    ->hiddenLabel()
                                    ->maxItems(1)
                                    ->disk('public')
                                    ->reorderable(false)
                                    ->schema([])
                                    ->nullable(),
                            ]),
                        Section::make(__('Meta'))
                            ->compact()
                            ->schema([
                                TextInput::make('slug')
                                    ->label(__('Slug'))
                                    ->maxLength(255)
                                    ->inlineLabel()
                                    ->columnSpanFull(),
                                Textarea::make('summary')
                                    ->label(__('Summary'))
                                    ->default('')
                                    ->maxLength(255)
                                    ->inlineLabel()
                                    ->columnSpanFull()
                                    ->dehydrateStateUsing(fn ($state) => $state ?? ''),
                                TextInput::make('weight')
                                    ->label(__('Weight'))
                                    ->default(0)
                                    ->numeric()
                                    ->step(1)
                                    ->inlineLabel()
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
                                    ->inlineLabel(),
                                DateTimePicker::make('created_at')
                                    ->label(__('Created At'))
                                    ->native(false)
                                    ->format('Y-m-d H:i:s')
                                    ->displayFormat('Y-m-d H:i:s')
                                    ->default(now())
                                    ->suffixIcon('heroicon-o-calendar')
                                    ->columnSpanFull()
                                    ->inlineLabel(),
                            ])
                            ->collapsible(),
                    ])->columnSpan(['xl' => 1]),
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
                    ->limit(50),
                IconColumn::make('status')
                    ->icon(fn ($state): string => match ($state) {
                        1 => 'heroicon-o-check-circle',
                        2 => 'heroicon-o-x-circle',
                        default => 'heroicon-o-question-mark-circle',
                    })
                    ->color(fn ($state): string => match ($state) {
                        1 => 'success',
                        2 => 'danger',
                        default => 'warning',
                    }),
                TextColumn::make('created_at')
                    ->label(__('Created At'))
                    ->dateTime('Y-m-d H:i:s')
                    ->sortable(),
            ])->filters([
                SelectFilter::make('status')
                    ->label(__('Status'))
                    ->options([
                        1 => 'Active',
                        2 => 'Suspended',
                    ]),
            ])->headerActions([
                //
            ])->actions([
                Tables\Actions\EditAction::make(),
            ])->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->defaultSort('created_at', 'desc');
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
