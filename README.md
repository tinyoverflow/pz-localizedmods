# LocalizedMods for Project Zomboid

> [!NOTE]
> This project, and especially this readme, is still a work in progress.

This repository contains translations for Project Zomboid mods that are available in the Steam Workshop. If you would
like to contribute to the project, see the Contributing Guide below.

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