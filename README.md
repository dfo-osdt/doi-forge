([Français](#doi-forge--gouvernance-et-orchestration-de-doi-pour-les-institutions))

# DOI Forge — DOI Governance and Orchestration for Institutions

DOI Forge is an open source DOI orchestration and governance layer for institutions that need multi-user control over their DataCite repositories. It sits between users and the DataCite API, adding role-based access control, metadata profiles, an approval workflow, and a full audit trail — capabilities that DataCite Fabrica does not provide natively.

## Who is this for?

Research institutes, libraries, government agencies, and universities with heterogeneous publishing processes that cannot adopt — or choose not to adopt — a dedicated data repository platform.

DOI Forge is **not** a DOI registry. DataCite remains the system of record for all DOIs. DOI Forge owns the governance: who requested an action, who approved it, and when.

## Key Features

- **Multi-user access control** — role-based permissions scoped to DataCite repositories
- **Approval workflow** — human review before any DOI transitions from draft to findable
- **Metadata profiles** — pre-configured templates that simplify DOI creation for different resource types
- **Full audit trail** — every action logged with attribution
- **REST API** — automated draft DOI creation from existing publishing systems
- **Landing page monitoring** — continuous availability checks on published DOI URLs
- **Bilingual** — English and French built-in

## Stack

| Component      | Technology                              |
| -------------- | --------------------------------------- |
| Backend        | Laravel 13, PHP 8.4                     |
| Frontend       | Vue 3 + Inertia.js, TypeScript          |
| UI             | shadcn-vue                              |
| Database       | SQLite                                  |
| Authentication | Microsoft Entra ID (prod), Breeze (dev) |
| API auth       | Laravel Sanctum                         |
| DataCite SDK   | `vincentauger/datacite-php-sdk`         |

See [`docs/design.md`](docs/design.md) for the full system design document.

## Getting Started

### Requirements

- PHP 8.4+
- Node.js 20+
- Redis (for Horizon queue worker)
- Composer
- pnpm

### Installation

```bash
git clone https://github.com/your-org/doi-forge.git
cd doi-forge
composer install
pnpm install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
pnpm run build
```

### Development

```bash
composer run dev
```

### Testing

```bash
php artisan test
```

## How to Contribute

See [CONTRIBUTING.md](CONTRIBUTING.md)

## License

Unless otherwise noted, the source code of this project is covered under Crown Copyright, Government of Canada, and is distributed under the [MIT License](LICENCE).

The Canada wordmark and related graphics associated with this distribution are protected under trademark law and copyright law. No permission is granted to use them outside the parameters of the Government of Canada's corporate identity program. For more information, see [Federal identity requirements](https://www.canada.ca/en/treasury-board-secretariat/topics/government-communications/federal-identity-requirements.html).

---

## DOI Forge — Gouvernance et orchestration de DOI pour les institutions

DOI Forge est une couche open source d'orchestration et de gouvernance de DOI pour les institutions qui ont besoin d'un contrôle multi-utilisateur sur leurs dépôts DataCite. Il se place entre les utilisateurs et l'API DataCite, ajoutant le contrôle d'accès basé sur les rôles, les profils de métadonnées, un flux d'approbation et une piste d'audit complète — des fonctionnalités que DataCite Fabrica ne fournit pas nativement.

## À qui s'adresse ce projet?

Les instituts de recherche, les bibliothèques, les agences gouvernementales et les universités ayant des processus de publication hétérogènes qui ne peuvent pas adopter — ou choisissent de ne pas adopter — une plateforme de dépôt de données dédiée.

DOI Forge **n'est pas** un registre de DOI. DataCite reste le système de référence pour tous les DOI. DOI Forge gère la gouvernance : qui a demandé une action, qui l'a approuvée, et quand.

## Fonctionnalités clés

- **Contrôle d'accès multi-utilisateur** — permissions basées sur les rôles, limitées aux dépôts DataCite
- **Flux d'approbation** — révision humaine avant qu'un DOI passe de brouillon à trouvable
- **Profils de métadonnées** — modèles pré-configurés qui simplifient la création de DOI pour différents types de ressources
- **Piste d'audit complète** — chaque action enregistrée avec attribution
- **API REST** — création automatisée de DOI brouillons à partir de systèmes de publication existants
- **Surveillance des pages d'atterrissage** — vérifications continues de la disponibilité des URL de DOI publiés
- **Bilingue** — anglais et français intégrés

## Comment contribuer

Voir [CONTRIBUTING.md](CONTRIBUTING.md)

## Licence

Sauf indication contraire, le code source de ce projet est protégé par le droit d'auteur de la Couronne du gouvernement du Canada et distribué sous la [licence MIT](LICENCE).

Le mot-symbole « Canada » et les éléments graphiques connexes liés à cette distribution sont protégés en vertu des lois portant sur les marques de commerce et le droit d'auteur. Aucune autorisation n'est accordée pour leur utilisation à l'extérieur des paramètres du programme de coordination de l'image de marque du gouvernement du Canada. Pour obtenir davantage de renseignements à ce sujet, veuillez consulter les [Exigences pour l'image de marque](https://www.canada.ca/fr/secretariat-conseil-tresor/sujets/communications-gouvernementales/exigences-image-marque.html).
