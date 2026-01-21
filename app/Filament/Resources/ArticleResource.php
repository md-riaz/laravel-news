<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Models\Article;
use App\Models\Category;
use App\Models\Reporter;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Content';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('category_id')
                    ->label('Category')
                    ->options(Category::query()->orderBy('name')->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('reporter_id')
                    ->label('Reporter')
                    ->options(Reporter::query()->orderBy('name')->pluck('name', 'id'))
                    ->searchable(),
                Forms\Components\TextInput::make('headline')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->helperText('Leave blank to auto-generate from the headline.')
                    ->maxLength(255),
                Forms\Components\Textarea::make('excerpt')
                    ->rows(3)
                    ->columnSpanFull(),
                Forms\Components\RichEditor::make('body')
                    ->columnSpanFull(),
                Forms\Components\Select::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'scheduled' => 'Scheduled',
                        'published' => 'Published',
                        'archived' => 'Archived',
                    ])
                    ->default('draft')
                    ->required(),
                Forms\Components\DateTimePicker::make('scheduled_for'),
                Forms\Components\DateTimePicker::make('published_at'),
                Forms\Components\Toggle::make('is_featured'),
                Forms\Components\Toggle::make('is_breaking'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('headline')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('category.name')->label('Category')->sortable(),
                Tables\Columns\TextColumn::make('reporter.name')->label('Reporter')->sortable(),
                Tables\Columns\TextColumn::make('status')->sortable(),
                Tables\Columns\IconColumn::make('is_featured')->boolean(),
                Tables\Columns\IconColumn::make('is_breaking')->boolean(),
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
