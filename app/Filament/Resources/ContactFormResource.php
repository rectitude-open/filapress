<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\ContactFormResource\Pages;
use App\Forms\Components\InfoAlert;
use App\Models\ContactForm;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContactFormResource extends Resource
{
    protected static ?string $model = ContactForm::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope-open';

    protected static ?int $navigationSort = 98;

    public static function getNavigationLabel(): string
    {
        return __('menu.nav_item.contact_form');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('menu.nav_group.content');
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                InfoAlert::make('info')
                    ->message(__('Please note that the content displayed on this page is provided by visitors. Exercise caution and verify information independently before relying on it.'))
                    ->type('warning')
                    ->columnSpanFull(),
                Grid::make(['sm' => 3])->schema([
                    Grid::make()->schema([
                        TextInput::make('subject')
                            ->label(__('Subject'))
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull()
                            ->dehydrateStateUsing(fn ($state) => $state ?? ''),
                        Textarea::make('message')
                            ->label(__('Message'))
                            ->default('')
                            ->rows(5)
                            ->columnSpanFull()
                            ->dehydrateStateUsing(fn ($state) => $state ?? ''),
                    ])->columnSpan(['xl' => 2]),
                    Grid::make()->schema([
                        Section::make(__('Visitor Information'))
                            ->compact()
                            ->schema([
                                TextInput::make('name')
                                    ->label(__('Name'))
                                    ->maxLength(255)
                                    ->inlineLabel()
                                    ->columnSpanFull()
                                    ->dehydrateStateUsing(fn ($state) => $state ?? ''),
                                TextInput::make('email')
                                    ->label(__('Email'))
                                    ->maxLength(255)
                                    ->inlineLabel()
                                    ->columnSpanFull()
                                    ->dehydrateStateUsing(fn ($state) => $state ?? ''),
                                TextInput::make('phone')
                                    ->label(__('Phone'))
                                    ->maxLength(255)
                                    ->inlineLabel()
                                    ->columnSpanFull()
                                    ->dehydrateStateUsing(fn ($state) => $state ?? ''),
                                TextInput::make('ip_address')
                                    ->label(__('IP Address'))
                                    ->maxLength(255)
                                    ->inlineLabel()
                                    ->columnSpanFull()
                                    ->dehydrateStateUsing(fn ($state) => $state ?? ''),
                                Textarea::make('user_agent')
                                    ->label(__('User Agent'))
                                    ->default('')
                                    ->rows(3)
                                    ->columnSpanFull()
                                    ->dehydrateStateUsing(fn ($state) => $state ?? ''),
                                DateTimePicker::make('created_at')
                                    ->label(__('Created At'))
                                    ->native(false)
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
                TextColumn::make('subject')
                    ->label(__('Title'))
                    ->searchable()
                    ->limit(50),
                TextColumn::make('name')
                    ->label(__('Name'))
                    ->searchable()
                    ->limit(50),
                TextColumn::make('created_at')
                    ->label(__('Created At'))
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
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
            'index' => Pages\ListContactForms::route('/'),
            'view' => Pages\ViewContactForm::route('/{record}'),
        ];
    }
}
