# 💬 Convention de Commits & Traçabilité (US18)

Afin d'assurer une lisibilité parfaite de l'évolution du "Quiz AI Education" et de garantir une relecture saine (Code Review), cette convention doit être appliquée par la totalité des intervenants humains et IA.

---

## 1. La Règle d'Or : Le Commit Atomique

**Un commit = Un seul sujet cohérent.**
- Ne mélangez *jamais* intentionnellement plusieurs sujets sans lien dans un même commit sous prétexte de "gagner du temps". 
- Si vous avez corrigé un bout de CSS (`div.hero`) et ajouté en même temps le Modèle Base de Données `Score`, séparez-les en **deux commits distincts**.
- *Objectif :* Permettre l'annulation facile d'une feature (`git revert`) sans casser le CSS d'une autre feature sans rapport.

---

## 2. Le Format (Conventional Commits)

Nous utilisons la sémantique Open-Source standardisée. Vos messages de commit doivent impérativement suivre cette structure :

```text
type: USXX - courte description claire de l'action

[Description optionnelle si complexe]
```

### Table des Préfixes Autorisés (Types)

| Préfixe  | Utilisation                                                                 |
|----------|-----------------------------------------------------------------------------|
| `feat:`  | Ajout d'une nouvelle fonctionnalité (Front ou Back).                        |
| `fix:`   | Correction d'un bug identifié.                                              |
| `docs:`  | Création ou ajout de fichier Markdown dans `/docs` ou `README.md`.        |
| `style:` | Modification du CSS, Tailwind, formatage (sans toucher à la logique).       |
| `refactor:`| Restructuration du code (ex: extraire un controlleur) sans impact visuel. |
| `test:`  | Ajout ou modification des tests unitaires PHPUnit / Pest.                   |
| `chore:` | Mis à jour d'outils, librairies NPM, nettoyage des logs `storage/logs`.     |

### ✅ Exemples de Commits Validés

- `feat: US09 - ajout du champ 'score' sur le dashboard étudiant` *(Parfait)*
- `fix: résolution du bouton envoyer inactif sur le quiz` *(Parfait)*
- `style: passage des boutons d'erreur en rouge` *(Parfait)*

### ❌ Exemples de Commits Interdits (Chaos)

- `ajout truc` *(Opaque, pas de préfixe)*
- `feat: fix du bug et ajout du dashboard et maj doc` *(Commit fourre-tout non atomique)*
- `update` *(Illisible en soutenance)*

---

## 3. Lien Test & Justification

Tout ajout logique lié à du vrai code algorithmique (`feat`, `fix`, `refactor`) doit inclure dans le même commit la modification ou création de ses tests associés.

> [!WARNING]  
> Si vous poussez un composant logique (ex: **Algorithme d'API LLM**) sans ajouter un fichier de Test (`test:` absent du PR), le corps (body) du commit **DOIT** stipuler la justification. 
> *Exemple : "Aucun test unitaire inséré car l'appel LLM est mocké par Axios pour le MVP à ce stade."* 
> 
> Cette traçabilité vous couvrira lors de la revue par les pairs.
