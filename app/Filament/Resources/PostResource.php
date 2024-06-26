<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Post;
use Filament\Tables;
use App\Models\Category;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Checkbox;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ColorPicker;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Forms\Components\MarkdownEditor;
use App\Filament\Resources\PostResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PostResource\RelationManagers;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationGroup = "Blog";

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Create a Post')
                    ->schema([
                        TextInput::make('title')->required(),
                        TextInput::make('slug')->required(),

                        Select::make('category_id')
                        ->label('Category')
                        ->relationship('category', 'name')
                        ->searchable()
                        ->options(Category::all()->pluck('name','id')),

                        ColorPicker::make('color')->required(),

                        MarkdownEditor::make('content')->required()->columnSpanFull(),
                    ])->columnSpan(2)->columns(2),

                Group::make()->schema([
                    Section::make("Image")
                        ->collapsible()
                        ->schema([
                            FileUpload::make('thumbnail')->disk('public')->directory('thumbnail'),
                    ])->columnSpan(1),
                    Section::make('Meta')->schema([
                        Checkbox::make('published')->required(),
                    ])

                    // Section::make('Authors')
                    // ->schema([
                    //     Select::make('authors')
                    //     ->multiple()
                    //     ->relationship('authors', 'name')
                    // ])
                ]),
                Select::make('tags')
                                    ->label('Tags')
                                    ->relationship('tag', 'name')
                                    ->multiple()
                                    ->searchable()
                                    ->preload()
                                    ->createOptionForm(function ($component) {
                                        return [
                                            TextInput::make('name')
                                                ->required()
                                                ->label('Tag Name'),
                                        ];
                                    })
                                    ->columnSpan('full'),
            ])->columns([
                'default' => 3,
                'sm' => 3,
                'md' => 3,
                'lg' => 3
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                ->sortable()
                ->searchable()
                ->toggleable(isToggledHiddenByDefault:true),
                ImageColumn::make('thumbnail')
                ->toggleable(),
                ColorColumn::make('color')
                ->toggleable(),
                TextColumn::make('title')
                ->sortable()
                ->searchable()
                ->toggleable(),
                TextColumn::make('slug')
                ->sortable()
                ->searchable()
                ->toggleable(),
                TextColumn::make('category.name')
                ->sortable()
                ->searchable()
                ->toggleable(),
                CheckboxColumn::make('published'),
                TextColumn::make('created_at')
                ->label('Published On')
                ->date()
                ->sortable()
                ->searchable()
                ->toggleable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
