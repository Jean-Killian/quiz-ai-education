# 🎨 BugHunter AI - Design System & UI/UX Guidelines

Ce document définit l'identité visuelle de **BugHunter AI**, le simulateur de traque de bugs pour développeurs. L'interface abandonne le style "scolaire" au profit d'une expérience immersive "Hacker Terminal".

---

## 1. Grilles et Typographie

L'expérience doit donner l'impression d'un cockpit de cybersécurité ou d'un terminal Linux.

- **Typographie principale (Mono) :** `Fira Code` (ou monospace standard). Elle est obligatoire pour tout ce qui touche au code et à la navigation.
- **Typographie secondaire (Sans) :** `Inter` pour les blocs de texte narratifs.
- **Titres :** Toujours en majuscules (Uppercase), tracking large (`tracking-widest`), souvent préfixés par des caractères de terminal (ex: `> `, `[+]`, `[-]`).
- **Layout :** Fond sombre (`bg-slate-900`), bordures fines (`border-slate-800`), accents de couleur néon.

---

## 2. Palette de Couleurs (Dark & Neon)

L'interface utilise une palette sombre pour réduire la fatigue visuelle du développeur et faire ressortir les éléments critiques.

- **Couleurs de fond :**
  - Surface : `slate-900` (#0f172a).
  - Éléments de carte : `slate-800` (#1e293b).
  - Terminal pur : `slate-950` (#020617).
- **Textes :**
  - Normal : `slate-300` ou `slate-400`.
  - Focus / Titre : `white`.
- **Accents (Primary) :** **Hacker Green** (#22c55e - `green-500`). Utilisé pour le succès, les sessions actives, et les CTAs principaux.
- **Alertes de Crise :** **Glitch Red** (#ef4444 - `red-500`). Utilisé pour les erreurs critiques, le logout, et les bugs non résolus.

---

## 3. Composants "Mission Control"

### 3.1. Boutons (Commandes)
- **Primary CTA :** Fond vert, texte noir (Font Black), sans arrondis prononcés (style rectangulaire/industriel). Effet de glow au survol.
- **Secondary CTA :** Bordure grise, fond transparent, texte gris clair.
- **Danger Zone :** Bordure rouge, texte rouge.

### 3.2. Formulaires (Inputs)
- Fond `slate-900`, bordure `slate-700`.
- Au focus, la bordure passe au vert néon avec une ombre interne subtile.
- Placeholder style code : `// tapez ici...`.

### 3.3. Tableaux et Listes (Target Logs)
- Ne pas utiliser de listes à puces Laravel par défaut.
- Utiliser des blocs avec des effets de "Scanlines" (lignes de balayage horizontales) ou des indicateurs de statut impulsifs (Animate-pulse).

---

## 4. Concepts UX : L'Immersion par le Code

### A. Le Hub de Mission (Dashboard)
Chaque quiz est présenté comme une **Cible** ou un **Log de Données**. On affiche le score en vert matrix (`08/10`).

### B. Le Debugger (Générateur)
Le formulaire de création doit ressembler à une injection de payload. On ne choisit pas un "Sujet", on choisit un "Vecteur d'analyse" (Langage) et un "Niveau d'intrusion" (Difficulté).

### C. La Traque (Quiz Player)
- Le code buggé est la star. Il doit être affiché dans une console noire avec une coloration syntaxique parfaite (`Highlight.js`).
- Les réponses ne sont pas des questions de cours mais des **Patches de Sécurité**.

### D. Analyse Post-Mortem (Expert Analysis)
- Une section "Terminal de débriefing" apparaît après chaque mission.
- Fond `slate-950` avec une bordure `blue-500/30`.
- Texte explicatif généré par l'IA formaté en Markdown (`Marked.js`).

### E. Le Hall of Fame (Leaderboard)
- Tableau style "Command Center".
- Rangs mis en évidence avec des trophées (Top 3) et des badges de grade (Elite Hunter, Active Agent).
- Ligne d'opérateur courant surlignée en vert néon.

---

> [!IMPORTANT]
> **Règle d'or :** Si l'interface ne ressemble pas à un terminal que l'on voudrait voir dans un film de hackers des années 90, elle n'est pas "BugHunter AI". Évitez les couleurs pastels, les ombres douces et les formes trop rondes.
