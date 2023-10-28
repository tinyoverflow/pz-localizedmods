# LocalizedMods for Project Zomboid

> [!NOTE]
> This project, and especially this readme, is still a work in progress. Automated compiling and publishing is planned.

This repository contains translations for Project Zomboid mods that are available in the Steam Workshop. If you would
like to contribute to the project, see the Contributing Guide below.

## How To Compile

Project Zomboid cannot use the JSON files from this repository. Therefore, these must first be converted. This project
uses PHP 8.1, so make sure that you have it installed.

1. Clone the repository.
2. Install the dependencies: `composer install`.
3. Execute `bin/compile.php`: `php bin/compile.php`.
4. The finished files will be in a folder called `output`.

## Contribute

I'm glad you want to join in. This repository is quite simple: In the `data` folder you will find all the
mod IDs that are currently supported by this project. If you want to translate a mod that we don't have yet,
create a new folder there with the workshop ID of the mod.

Inside this folder, create JSON files with the same names as the translation files of the mod itself.
itself. For example, `ItemName.json`. We follow this format, where `CC` corresponds to the country code that
Project Zomboid uses internally:

```json
{
  "Section_TranslationKey": {
    "CC": "Translated text"
  }
}
```

Check out the other mods' folders if you need some support.