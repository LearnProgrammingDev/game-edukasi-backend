<?php

namespace App\Filament\Admin\Resources\Nodes\Schemas;

use Filament\Schemas\Components\Section; // ← BUKAN Forms\Components\Section
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class NodeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Node')
                ->schema([
                    TextInput::make('title')
                        ->label('Judul Node')
                        ->required()
                        ->maxLength(255)
                        ->columnSpanFull(),

                    Select::make('type')
                        ->label('Tipe Node')
                        ->options([
                            'materi'      => 'Materi (Baca)',
                            'kuis'        => 'Kuis (Tantangan)',
                            'percabangan' => 'Percabangan',
                        ])
                        ->required(),

                    TextInput::make('order')
                        ->label('Urutan')
                        ->numeric()
                        ->required()
                        ->default(1),

                    TextInput::make('exp_reward')
                        ->label('Reward EXP')
                        ->numeric()
                        ->required()
                        ->default(100),
                ])->columns(2),

            Section::make('Konten Markdown')
                ->description('Tulis materi dalam format Markdown.')
                ->schema([
                    Textarea::make('content')
                        ->label('Konten')
                        ->rows(20)
                        ->columnSpanFull()
                        ->placeholder("# Judul\n\nPenjelasan...\n\n```php\nRoute::get('/', fn() => 'Hello');\n```"),
                ]),

            Section::make('Posisi di Peta')
                ->schema([
                    TextInput::make('x_position')->label('Posisi X')->numeric()->default(150),
                    TextInput::make('y_position')->label('Posisi Y')->numeric()->default(0),
                ])->columns(2),
        ]);
    }
}
