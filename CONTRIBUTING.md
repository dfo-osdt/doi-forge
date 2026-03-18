([Français](#comment-contribuer))

# Contributing

When contributing, post comments and discuss changes you wish to make via Issues.

Feel free to propose changes by creating Pull Requests. If you don't have write access, editing a file will create a Fork of this project for you to save your proposed changes to. Submitting a change to a file will write it to a new Branch in your Fork, so you can send a Pull Request.

If this is your first time contributing on GitHub, don't worry! Let us know if you have any questions.

## Development Setup

### Requirements

- PHP 8.4+
- Node.js 20+
- pnpm
- Composer

### Getting started

```bash
git clone https://github.com/dfo-mpo/doi-forge.git
cd doi-forge
composer install
pnpm install
pnpm exec lefthook install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
```

Then start all services with:

```bash
composer run dev
```

### Git hooks

This project uses [Lefthook](https://github.com/evilmartians/lefthook) to enforce code quality before every commit. Running `pnpm exec lefthook install` (done above) sets up two hooks:

- **pre-commit** — runs [Pint](https://laravel.com/docs/pint) on staged PHP files and [ESLint](https://eslint.org/) on staged TypeScript/Vue files, auto-fixing issues
- **commit-msg** — validates your commit message against the Conventional Commits format

If a hook fails, fix the reported issues and re-stage your files before committing again.

## Commit Messages

This project uses [Conventional Commits](https://www.conventionalcommits.org/). All commit messages must follow this format:

```
<type>[optional scope]: <description>

[optional body]

[optional footer(s)]
```

Common types: `feat`, `fix`, `docs`, `chore`, `refactor`, `test`, `perf`.

Examples:

```
feat(dois): add autosave on form change
fix(api): return 422 when profile slug is invalid
docs: update deployment guide
chore: upgrade to Laravel 13.5
```

Breaking changes must include `!` after the type or a `BREAKING CHANGE:` footer.

## Security

**Do not post any security issues on the public repository!** See [SECURITY.md](SECURITY.md)

---

## Comment contribuer

Lorsque vous contribuez, veuillez également publier des commentaires et discuter des modifications que vous souhaitez apporter par l'entremise des enjeux (Issues).

N'hésitez pas à proposer des modifications en créant des demandes de tirage (Pull Requests). Si vous n'avez pas accès au mode de rédaction, la modification d'un fichier créera une copie (Fork) de ce projet afin que vous puissiez enregistrer les modifications que vous proposez. Le fait de proposer une modification à un fichier l'écrira dans une nouvelle branche dans votre copie (Fork), de sorte que vous puissiez envoyer une demande de tirage (Pull Request).

Si c'est la première fois que vous contribuez à GitHub, ne vous en faites pas! Faites-nous part de vos questions.

## Configuration de l'environnement de développement

### Prérequis

- PHP 8.4+
- Node.js 20+
- pnpm
- Composer

### Démarrage

```bash
git clone https://github.com/dfo-mpo/doi-forge.git
cd doi-forge
composer install
pnpm install
pnpm exec lefthook install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
```

Démarrez ensuite tous les services avec :

```bash
composer run dev
```

### Hooks Git

Ce projet utilise [Lefthook](https://github.com/evilmartians/lefthook) pour assurer la qualité du code avant chaque commit. La commande `pnpm exec lefthook install` (exécutée ci-dessus) configure deux hooks :

- **pre-commit** — exécute [Pint](https://laravel.com/docs/pint) sur les fichiers PHP stagés et [ESLint](https://eslint.org/) sur les fichiers TypeScript/Vue stagés, en corrigeant automatiquement les problèmes
- **commit-msg** — valide votre message de commit selon le format des Commits conventionnels

Si un hook échoue, corrigez les problèmes signalés et re-stagez vos fichiers avant de committer à nouveau.

## Messages de commit

Ce projet utilise les [Commits conventionnels](https://www.conventionalcommits.org/fr/). Tous les messages de commit doivent respecter ce format :

```
<type>[portée optionnelle]: <description>

[corps optionnel]

[pied(s) de page optionnel(s)]
```

Types courants : `feat`, `fix`, `docs`, `chore`, `refactor`, `test`, `perf`.

Exemples :

```
feat(dois): ajout de la sauvegarde automatique du formulaire
fix(api): retourner 422 si le slug de profil est invalide
docs: mise à jour du guide de déploiement
chore: mise à niveau vers Laravel 13.5
```

Les changements majeurs doivent inclure `!` après le type ou un pied de page `BREAKING CHANGE:`.

## Sécurité

**Ne publiez aucun problème de sécurité sur le dépôt publique!** Voir [SECURITY.md](SECURITY.md)
