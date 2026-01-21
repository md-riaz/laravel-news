<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReporterResource\Pages;
use App\Models\Reporter;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ReporterResource extends Resource
{
    protected static ?string $model = Reporter::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationGroup = 'People';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->helperText('Leave blank to auto-generate from the name.')
                    ->maxLength(255),
                Forms\Components\Textarea::make('bio')
                    ->rows(4)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('avatar_url')
                    ->label('Avatar URL')
                    ->url()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('slug')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('updated_at')->dateTime()->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReporters::route('/'),
            'create' => Pages\CreateReporter::route('/create'),
            'edit' => Pages\EditReporter::route('/{record}/edit'),
        ];
    }
}
