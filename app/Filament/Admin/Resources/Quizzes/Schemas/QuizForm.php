<?php

namespace App\Filament\Admin\Resources\Quizzes\Schemas;

use App\Models\Node;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Section; // ← fix
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class QuizForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Soal')
                ->schema([
                    Select::make('node_id')
                        ->label('Node Kuis')
                        ->options(
                            Node::where('type', 'kuis')
                                ->orderBy('order')
                                ->pluck('title', 'id')
                        )
                        ->required()
                        ->searchable(),

                    Select::make('type')
                        ->label('Tipe Soal')
                        ->options([
                            'multiple_choice' => 'Pilihan Ganda',
                            'fill_blank'      => 'Isi Titik-Titik',
                            'arrange_code'    => 'Susun Kode',
                        ])
                        ->required()
                        ->live(),

                    TextInput::make('order')
                        ->label('Urutan Soal')
                        ->numeric()
                        ->default(1),
                ])->columns(2),

            Section::make('Pertanyaan & Jawaban')
                ->schema([
                    Textarea::make('question')
                        ->label('Pertanyaan')
                        ->required()
                        ->rows(5)
                        ->columnSpanFull(),

                    Repeater::make('options')
                        ->label('Pilihan Jawaban')
                        ->schema([
                            TextInput::make('option')
                                ->label('Pilihan')
                                ->required()
                                ->placeholder('Contoh: A. PHP'),
                        ])
                        ->visible(fn(Get $get): bool => $get('type') === 'multiple_choice')
                        ->minItems(2)
                        ->maxItems(4)
                        ->defaultItems(4)
                        ->columnSpanFull()
                        ->afterStateHydrated(function ($component, $state) {
                            if (is_array($state) && !empty($state) && !isset($state[0]['option'])) {
                                $component->state(
                                    collect($state)->map(fn($v) => ['option' => $v])->toArray()
                                );
                            }
                        })
                        ->dehydrateStateUsing(
                            fn($state) =>
                            collect($state)->pluck('option')->values()->toArray()
                        ),

                    TextInput::make('correct_answer')
                        ->label('Kunci Jawaban')
                        ->required()
                        ->columnSpanFull()
                        ->helperText('Pilihan ganda: "A. PHP" | Isi titik: "get" | Susun kode: "1,0,2"'),

                    Textarea::make('hint')
                        ->label('Petunjuk / Hint')
                        ->rows(2)
                        ->columnSpanFull()
                        ->placeholder('Muncul setelah siswa salah 3 kali'),
                ]),
        ]);
    }
}
