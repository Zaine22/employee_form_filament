<?php

namespace App\Filament\Resources;

use App\Enums\GenderEnum;
use App\Filament\Resources\EmployeeResource\Pages;
use App\Models\Employee;
use App\Models\Nrc;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Step::make('Employee Info')
                        ->schema([
                            Section::make('employees')
                                ->schema([
                                    TextInput::make('name_enn')
                                        ->label('Employee Name(English)')
                                        ->required()

                                        ->live(onBlur: true),
                                    TextInput::make('name_mm')
                                        ->label('Employee Name(Myanmar)')
                                        ->required()
                                        ->live(onBlur: true),

                                    TextInput::make('father_name')
                                        ->label('Father Name')
                                        ->required()
                                        ->live(onBlur: true),

                                    DatePicker::make('date_of_birth')
                                        ->label('Date of Birth')
                                        ->required(),

                                    TextInput::make('race')
                                        ->label('Race')
                                        ->required()
                                        ->live(onBlur: true),

                                    Select::make('religion')
                                        ->options([
                                            "Buddhist" => "Buddhist",
                                            "Christianity" => "Christianity",
                                            "Islam" => "Islam",
                                            "Hunduism" => "Hunduism",
                                            "Other" => "Other",
                                            "No Religion" => "No Religion",

                                        ]),

                                    Select::make('nationality')
                                        ->options([
                                            "Kachin" => "Kachin",
                                            "Kayah" => "Kayah",
                                            "Kayin" => "Kayin",
                                            "Chin" => "Chin",
                                            "Burma" => "Burma",
                                            "Mon" => "Mon",
                                            "Rakhine" => "Rakhine",
                                            "Shan" => "Shan",
                                        ]),
                                    Select::make('vacancy')
                                        ->options([
                                            "Junior Web Developer" => "Junior Web Developer",
                                            "Web Developer" => "Web Developer",
                                            "Web Designer" => "Web Designer",
                                        ]),

                                    TextInput::make('passport_no')
                                        ->label('Passport No')
                                        ->required()
                                        ->live(onBlur: true),

                                    TextInput::make('driver_license')
                                        ->label('Driver License')
                                        ->required()
                                        ->live(onBlur: true),

                                    Fieldset::make('NRC')
                                        ->schema([
                                            Select::make('nrcs_id')
                                                ->label('Code')
                                                ->options(Nrc::select('nrc_code')->distinct()->orderBy('nrc_code', 'asc')->pluck('nrc_code'))
                                                ->live()
                                                ->afterStateUpdated(fn(Set $set, ?string $state) => $set('name_en', Nrc::select('name_en')->where('nrc_code', ++$state)->pluck('name_en'))),

                                            Select::make('nrcs_n')
                                                ->label('Distinct')
                                                ->options(function ($get) {
                                                    return $get('name_en');}),

                                            Select::make('type')
                                                ->label('Type')
                                                ->options([
                                                    "N" => "N",
                                                    "P" => "P",
                                                    "A" => "A",
                                                ]),

                                            TextInput::make('nrc_num')
                                                ->label('Number')
                                                ->required()
                                                ->live(onBlur: true),

                                        ])->columns(4)->columnSpan(1),

                                    Select::make('gender')
                                        ->options([
                                            "Male" => GenderEnum::MALE->value,
                                            "Female" => GenderEnum::FAMALE->value,
                                        ]),
                                    Select::make('blood')
                                        ->options([
                                            "A" => "A",
                                            "B" => "B",
                                            "AB" => "AB",
                                            "O" => "O",
                                        ]),
                                    Select::make('marital_status')
                                        ->options([
                                            "Single" => "Single",
                                            "Married" => "Married",
                                        ]),

                                    TextInput::make('hph_no')
                                        ->label('Home Phone')
                                        ->required()
                                        ->live(onBlur: true),

                                    TextInput::make('ph_no')
                                        ->label('Mobile Phone')
                                        ->required()
                                        ->live(onBlur: true),

                                    TextInput::make('url')
                                        ->label('URL')
                                        ->placeholder('Social Media Url(eg. facebook,twitter,instagram,etc)')
                                        ->live(onBlur: true)
                                        ->required()
                                        ->columnSpan(2),

                                ])->columns(3),
                        ]),
                    Step::make('Background Info')
                        ->schema([
                            Repeater::make('education')
                                ->label('Education')
                                ->relationship()
                                ->schema([
                                    TextInput::make('degree')
                                        ->label('Education/Degree')
                                        ->live(onBlur: true)
                                        ->required()
                                        ->columnSpan(2),

                                    DatePicker::make('from_date')
                                        ->required()
                                        ->label('From'),

                                    DatePicker::make('to_date')
                                        ->required()
                                        ->label('To'),

                                    TextInput::make('university')
                                        ->label('School/College/University')
                                        ->required()
                                        ->live(onBlur: true)
                                        ->columnSpan(2),
                                ])->columns(6),

                            Repeater::make('work')
                                ->label('Work Experience')
                                ->relationship()
                                ->schema([
                                    TextInput::make('title')
                                        ->label('Job Title')
                                        ->live(onBlur: true)
                                        ->required()
                                        ->columnSpan(2),

                                    TextInput::make('company_name')
                                        ->label('Company Name')
                                        ->required()
                                        ->live(onBlur: true)
                                        ->columnSpan(2),

                                    DatePicker::make('from_date')
                                        ->required()
                                        ->label('From'),

                                    DatePicker::make('to_date')
                                        ->required()
                                        ->label('To'),

                                    TextInput::make('employer_phno')
                                        ->label('Employer Contact')
                                        ->placeholder('Employer Contact eg.(09876765423)')
                                        ->required()
                                        ->live(onBlur: true)
                                        ->columnSpan(2),

                                    TextInput::make('employer_address')
                                        ->label('Employer Address')
                                        ->placeholder('Employer Address')
                                        ->required()
                                        ->live(onBlur: true)
                                        ->columnSpan(4),

                                    FileUpload::make('attachment')
                                        ->label('Select Attachment')
                                        ->required()
                                        ->hint('
                                        Accepts.docx,doc,pdf up to 5MB')
                                        ->columnSpan(4),
                                ])->columns(6),

                            Repeater::make('rpeople')
                                ->label('Reference Person')
                                ->relationship()
                                ->schema([
                                    TextInput::make('name')
                                        ->required()
                                        ->label('Reference Person Name')
                                        ->placeholder('U Ye Htet')
                                        ->live(onBlur: true),

                                    TextInput::make('position')
                                        ->required()
                                        ->label('Job Position')
                                        ->placeholder('Position')
                                        ->live(onBlur: true),

                                    TextInput::make('email')
                                        ->label('Email')
                                        ->required()
                                        ->placeholder('mtz@za.com.mm')
                                        ->live(onBlur: true),

                                    TextInput::make('ph_no')
                                        ->required()
                                        ->label('Phone')
                                        ->placeholder('09456785669')
                                        ->live(onBlur: true),
                                ])->columns(4),

                            Repeater::make('fmembers')
                                ->label('Reference Person')
                                ->relationship()
                                ->schema([
                                    TextInput::make('name')
                                        ->required()
                                        ->label('Reference Person Name')
                                        ->placeholder('Family Member Name')
                                        ->live(onBlur: true),

                                    TextInput::make('relationship')
                                        ->required()
                                        ->label('Relationship')
                                        ->placeholder('Relationship')
                                        ->live(onBlur: true),

                                    DatePicker::make('date_of_birth')
                                        ->required()
                                        ->label('Date of Birth')
                                        ->placeholder('Date of Birth')
                                        ->live(onBlur: true),

                                    TextInput::make('occupation')
                                        ->required()
                                        ->label('Occupation')
                                        ->placeholder('Occupation')
                                        ->live(onBlur: true),

                                    TextInput::make('ph_no')
                                        ->required()
                                        ->label('Contact Number')
                                        ->placeholder('Contact Number')
                                        ->live(onBlur: true),

                                    TextInput::make('address')
                                        ->required()
                                        ->label('Contact Address')
                                        ->placeholder('Contact Address')
                                        ->live(onBlur: true)
                                        ->columnSpan(3),
                                ])->columns(4),
                        ]),
                    Step::make('Address')
                        ->schema([
                            Repeater::make('address')
                                ->label('Address')
                                ->relationship()
                                ->schema([
                                    TextInput::make('country')
                                        ->required()
                                        ->label('Country')
                                        ->live(onBlur: true)
                                        ->columnSpan(2),

                                    TextInput::make('state')
                                        ->required()
                                        ->label('State')
                                        ->live(onBlur: true)
                                        ->columnSpan(2),

                                    TextInput::make('township')
                                        ->required()
                                        ->label('Township')
                                        ->live(onBlur: true)
                                        ->columnSpan(2),

                                    TextInput::make('street')
                                        ->required()
                                        ->label('Street')
                                        ->live(onBlur: true)
                                        ->columnSpan(2),
                                ])->columns(4),
                        ]),
                ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name_enn')
                    ->label('Name'),
                TextColumn::make('vacancy')
                    ->label('Position'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
            ]);
        // ->bulkActions([
        //     Tables\Actions\BulkActionGroup::make([
        //         Tables\Actions\DeleteBulkAction::make(),
        //     ]),
        // ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('name_enn')
                    ->label('Name'),
                TextEntry::make('vacancy')
                    ->label('Position'),
                TextEntry::make('father_name')
                    ->label('Father Name'),
                TextEntry::make('date_of_birth')
                    ->label('Date Of Birth'),
                TextEntry::make('gender')
                    ->label('Gender'),
                TextEntry::make('nrc_no')
                    ->label('NRCS'),
                TextEntry::make('race')
                    ->label('Race'),
                TextEntry::make('religion')
                    ->label('Religion'),
                TextEntry::make('nationality')
                    ->label('Nationality'),
                TextEntry::make('passport_no')
                    ->label('Passport No'),
                TextEntry::make('marital_status')
                    ->label('Marital Status'),
                DeleteAction::make(),
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            // 'view' => Pages\ViewEmployee::route('/{record}'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
