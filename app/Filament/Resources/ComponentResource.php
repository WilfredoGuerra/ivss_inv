<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComponentResource\Pages;
use App\Filament\Resources\ComponentResource\RelationManagers;
use App\Models\Component;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use App\Filament\Resources\ComponentResource\Widgets\ComponentStatsOverview;


class ComponentResource extends Resource
{
    protected static ?string $model = Component::class;

    protected static ?string $navigationLabel = 'Componentes';
    protected static ?string $navigationIcon = 'heroicon-o-tv';
    // protected static ?string $navigationGroup = 'System Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('categories_id')
                    ->relationship('categories', 'description')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->label('Categoría'),
                Forms\Components\Select::make('brands_id')
                    ->relationship('brands', 'description')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->label('Marca'),
                Forms\Components\Select::make('departments_id')
                    ->relationship('departments', 'description')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->label('Departamento'),
                Forms\Components\Select::make('locations_id')
                    ->relationship('locations', 'description')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->label('Localidad'),
                Forms\Components\Select::make('states_id')
                    ->relationship('states', 'description')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->label('Estado físico'),
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->maxLength(255)
                    ->label('Descripción'),
                Forms\Components\TextInput::make('serial')
                    ->required()
                    ->maxLength(255)
                    ->label('Serial original'),
                Forms\Components\TextInput::make('asset_number')
                    ->required()
                    ->maxLength(255)
                    ->label('Nº Bien Nacional'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('categories.description')
                    ->numeric()
                    ->sortable()
                    ->searchable()
                    ->label('Categoría'),
                Tables\Columns\TextColumn::make('brands.description')
                    ->numeric()
                    ->sortable()
                    ->searchable()
                    ->label('Marca'),
                Tables\Columns\TextColumn::make('departments.description')
                    ->numeric()
                    ->sortable()
                    ->searchable()
                    ->label('Departamento'),
                Tables\Columns\TextColumn::make('locations.description')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault:true)
                    ->searchable()
                    ->label('Localidad'),
                Tables\Columns\TextColumn::make('states.description')
                    ->numeric()
                    ->sortable()
                    ->searchable()
                    ->label('Estado físico'),
                Tables\Columns\TextColumn::make('description')
                    ->searchable()
                    ->label('Descripción'),
                Tables\Columns\TextColumn::make('serial')
                    ->searchable()
                    ->label('Serial'),
                Tables\Columns\TextColumn::make('asset_number')
                    ->searchable()
                    ->label('Nº B/N'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d-m-y H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Fecha creación'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('d-m-y H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Fecha actualización'),
            ])
            ->filters([
                SelectFilter::make('departments')
                ->relationship('departments', 'description')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make(),]),
                ExportBulkAction::make()
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getWidgets(): array
    {
        return [
            ComponentStatsOverview::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListComponents::route('/'),
            'create' => Pages\CreateComponent::route('/create'),
            'edit' => Pages\EditComponent::route('/{record}/edit'),
        ];
    }
}
