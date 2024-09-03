<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Models\Expense;
use App\Models\User; 

class ExpensesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        
        $user = User::first(); 

        //  Validazione utente
        if ($user) {
            for ($i = 0; $i < 10; $i++) {
                $newExpense = new Expense();
                $newExpense->name = $faker->word();
                $newExpense->image = 'https://picsum.photos/200/300';
                $newExpense->slug = Str::slug($newExpense->name, '-');
                $newExpense->user_id = $user->id; 
                $newExpense->save();
            }
        } else {
            // Se non ci sono utenti nel database, segnala un errore
            $this->command->error('Nessun utente trovato. Inserisci almeno un utente prima di eseguire il seeder delle spese.');
        }
    }
}
