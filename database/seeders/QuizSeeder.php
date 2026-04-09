<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        // Mission 01: Junior PHP
        $q1 = Quiz::create([
            'title' => 'Mission_Alpha : Injection_SQL',
            'description' => 'Un serveur Legacy (PHP) utilise des requêtes brutes. Identifie et corrige la vulnérabilité avant que les données ne fuitent.',
            'difficulty' => 'Junior',
        ]);

        $quest1 = Question::create([
            'quiz_id' => $q1->id,
            'question_text' => "```php\n// Le code suivant est vulnérable :\n\$id = \$_GET['id'];\n\$query = \"SELECT * FROM users WHERE id = \" . \$id;\n\$result = \$conn->query(\$query);\n```",
            'explanation' => "L'injection SQL survient ici car la variable \$_GET['id'] est concaténée directement dans la chaîne SQL sans nettoyage ni préparation. Un attaquant peut injecter des commandes SQL via l'URL.",
        ]);

        Answer::create(['question_id' => $quest1->id, 'answer_text' => "Utiliser des requêtes préparées (PDO statements)", 'is_correct' => true]);
        Answer::create(['question_id' => $quest1->id, 'answer_text' => "Utiliser htmlspecialchars() sur l'ID", 'is_correct' => false]);
        Answer::create(['question_id' => $quest1->id, 'answer_text' => "Ajouter des guillemets autour de \$id", 'is_correct' => false]);

        // Mission 02: Medior JavaScript
        $q2 = Quiz::create([
            'title' => 'Mission_Beta : Race_Condition',
            'description' => 'Un bug asynchrone dans le frontend cause des incohérences de données. Détecte la faille dans les promesses JS.',
            'difficulty' => 'Medior',
        ]);

        $quest2 = Question::create([
            'quiz_id' => $q2->id,
            'question_text' => "```javascript\nlet data = null;\nasync function fetchData() {\n    const response = await fetch('/api/data');\n    data = await response.json();\n}\nfetchData();\nconsole.log(data);\n```",
            'explanation' => "Le console.log s'exécutera AVANT que fetchData n'ait terminé son exécution car fetchData() (sans await) est asynchrone et ne bloque pas le flux principal.",
        ]);

        Answer::create(['question_id' => $quest2->id, 'answer_text' => "Il manque un 'await' avant l'appel de fetchData()", 'is_correct' => true]);
        Answer::create(['question_id' => $quest2->id, 'answer_text' => "La variable 'data' doit être 'const'", 'is_correct' => false]);
        Answer::create(['question_id' => $quest2->id, 'answer_text' => "L'API fetch ne retourne pas de JSON directement", 'is_correct' => false]);

        // Mission 03: Senior C++ / Memory
        $q3 = Quiz::create([
            'title' => 'Mission_Gamma : Memory_Leak',
            'description' => 'Analyse une fuite de mémoire critique dans un module de cryptage C++. Optimise l\'utilisation des pointeurs.',
            'difficulty' => 'Senior',
        ]);

        $quest3 = Question::create([
            'quiz_id' => $q3->id,
            'question_text' => "```cpp\nvoid processData() {\n    int* buffer = new int[1024];\n    if (encrypt(buffer) == FAILED) {\n        return;\n    }\n    delete[] buffer;\n}\n```",
            'explanation' => "Si encrypt() échoue, la fonction retourne prématurément sans appeler delete[], causant une fuite de mémoire. Utiliser un smart pointer (std::unique_ptr) est la solution moderne préférée.",
        ]);

        Answer::create(['question_id' => $quest3->id, 'answer_text' => "Utiliser std::unique_ptr pour une gestion automatique de la mémoire (RAII)", 'is_correct' => true]);
        Answer::create(['question_id' => $quest3->id, 'answer_text' => "Augmenter la taille du buffer pour éviter l'échec", 'is_correct' => false]);
        Answer::create(['question_id' => $quest3->id, 'answer_text' => "Supprimer la condition IF", 'is_correct' => false]);
    }
}
