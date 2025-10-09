# Translation Guide - Qualixce Project

## Overview
This project uses **Spatie Laravel Translatable** for content translations and standard Laravel language files for UI translations.

## How It Works

### 1. Content Translations (Spatie Translatable)
Content like titles, descriptions, and other database fields are stored **directly in the database** as JSON.

#### Example Database Structure:
```json
{
  "title": {
    "en": "Welcome to Qualixce",
    "ar": "مرحباً بك في كواليكس"
  },
  "subtitle": {
    "en": "Your trusted partner",
    "ar": "شريكك الموثوق"
  }
}
```

#### Models with Translations:
All models in `app/Models/` use the `HasTranslations` trait:
- `HeroSection`
- `AboutQualixceSection`
- `ExcellenceArea`
- `FounderMessage`
- `GetYourConsultation`
- `OurService`
- `OurValue`
- `ProvenProcess`
- `WhyChooseUs`

#### In Filament Admin:
When you edit a resource, you'll see **language tabs** (EN/AR) at the top of translatable fields. Simply switch between tabs to enter content in different languages.

### 2. UI Translations (Laravel Language Files)
Static UI text (buttons, labels, messages) are stored in language files:

#### File Structure:
```
resources/lang/
├── en.json          # English UI strings (JSON format)
├── ar.json          # Arabic UI strings (JSON format)
├── en/
│   ├── messages.php # English messages for views
│   ├── admin.php    # English admin panel labels
│   └── validation.php # English validation messages
└── ar/
    ├── messages.php # Arabic messages for views
    ├── admin.php    # Arabic admin panel labels
    └── validation.php # Arabic validation messages
```

#### Usage in Blade Views:
```blade
<!-- Using JSON translations -->
{{ __('Dashboard') }}

<!-- Using PHP file translations -->
{{ __('messages.hero_title') }}
{{ __('admin.create') }}
```

## Configuration

### Available Locales
Defined in `config/app.php`:
```php
'available_locales' => [
    'en' => 'English',
    'ar' => 'العربية',
],
```

### Spatie Config
Located in `config/translatable.php`:
- Default locale: `en`
- Available locales: `['en', 'ar']`
- Fallback enabled: `true`

### Filament Panel
Configured in `app/Providers/Filament/AdminPanelProvider.php`:
```php
->plugin(
    SpatieLaravelTranslatablePlugin::make()
        ->defaultLocales(['en', 'ar'])
)
```

### Language Switcher
The Filament Language Switch package is configured in `app/Providers/AppServiceProvider.php` to allow switching between Arabic and English in the admin panel.

## How to Add Translations

### For Database Content (Spatie):
1. Go to Filament admin panel
2. Edit any resource (Hero Section, Services, etc.)
3. Click the language tabs (EN/AR) at the top
4. Enter content for each language
5. Save

### For UI Text:
1. Add the translation key to both `resources/lang/en.json` and `resources/lang/ar.json`
2. OR add to the appropriate PHP file (`messages.php`, `admin.php`)
3. Use `{{ __('your.key') }}` in your Blade views

## Language Switching

### In Admin Panel:
- Use the language switcher in the top navigation
- Configured via `bezhansalleh/filament-language-switch` package

### For Frontend (if needed):
- Use the `SetLocale` middleware in `app/Http/Middleware/SetLocale.php`
- Locale is stored in session
- Can be changed via URL parameter: `?locale=ar` or `?locale=en`

## Important Notes

1. **Content vs UI**: 
   - Database content (titles, descriptions) → Spatie (stored in DB)
   - UI elements (buttons, labels) → Laravel language files

2. **Filament Resources**: 
   - All resources already use `Translatable` trait
   - Language tabs appear automatically for translatable fields

3. **Models**: 
   - All models have `HasTranslations` trait
   - `$translatable` property defines which fields are translatable

4. **Fallback**: 
   - If a translation is missing, it falls back to English

## Testing Translations

1. **Admin Panel**: Visit `/admin` and switch languages using the language switcher
2. **Database**: Check that translatable fields store JSON with both `en` and `ar` keys
3. **Frontend**: Change locale and verify UI text changes accordingly

## Packages Used

- `spatie/laravel-translatable` - For database content translations
- `filament/spatie-laravel-translatable-plugin` - Filament integration
- `bezhansalleh/filament-language-switch` - Language switcher in admin panel
