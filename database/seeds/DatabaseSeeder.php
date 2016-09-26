<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Pilote;
use App\Saison;
use App\Trophee;
use App\Circuit;
use App\Course;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('courses')->delete();
        DB::table('circuits')->delete();
        DB::table('trophees')->delete();
        DB::table('saisons')->delete();
        DB::table('users')->delete();

        $users = array(
                ['prenom' => 'Alexandre', 'nom' => 'HOMBERGER', 'email' => 'alexandre.homberger@gmail.com', 'password' => 'test', 'sexe' => 'male', 'date_naissance' => '1980-07-02' ],
                ['prenom' => 'Marvyn', 'nom' => 'PANNETIER', 'email' => 'marvyn.pannetier@gmail.com', 'password' => 'test', 'sexe' => 'male', 'date_naissance' => '1999-08-05' ],
        );
        
        foreach ($users as $user)
        {
            User::create($user);
        }
        
        $saisons = array(
                ['annee' => 2015],
                ['annee' => 2016],
        );
        
        foreach ($saisons as $saison)
        {
            Saison::create($saison);
        }


        $trophees = array(
                ['nom' => 'Trophée UFOLEP Aquitaine 15', 'saison_id' => DB::table('saisons')
                                ->select('id')
                                ->where('annee', 2015)
                                ->first()
                                ->id],
                ['nom' => 'Trophée UFOLEP Aquitaine 16', 'saison_id' => DB::table('saisons')
                                ->select('id')
                                ->where('annee', 2016)
                                ->first()
                                ->id],
        );
        
        foreach ($trophees as $trophee)
        {
            Trophee::create($trophee);
        }

        $circuits = array(
                ['nom' => 'Magescq'],
                ['nom' => 'Layrac'],
                ['nom' => 'Biscarrosse'],
                ['nom' => 'Teyjat Nontron'],
                ['nom' => 'Val d\'Argenton'],
                ['nom' => 'St Genis de Saintonge'],
                ['nom' => 'Biganos'],
                ['nom' => 'Pau Lescar'],
        );
            
        foreach ($circuits as $circuit)
        {
            Circuit::create($circuit);
        }

        $trophe_2016 = DB::table('trophees')->select('id')
                                ->where('saison_id', DB::table('saisons')
                                    ->select('id')
                                    ->where('annee', 2016)
                                    ->first()
                                    ->id)
                                ->first()
                                ->id;

        $courses = array(
                ['date' => '2016-03-06', 'trophee_id' => $trophe_2016, 'circuit_id' => DB::table('circuits')
                                    ->select('id')
                                    ->where('nom', 'Magescq')
                                    ->first()
                                    ->id, 'sens_inverse' => 0, 'annulee' => 0],
                ['date' => '2016-03-27', 'trophee_id' => $trophe_2016, 'circuit_id' => DB::table('circuits')
                                    ->select('id')
                                    ->where('nom', 'Layrac')
                                    ->first()
                                    ->id, 'sens_inverse' => 0, 'annulee' => 0],
                ['date' => '2016-05-01', 'trophee_id' => $trophe_2016, 'circuit_id' => DB::table('circuits')
                                    ->select('id')
                                    ->where('nom', 'Teyjat Nontron')
                                    ->first()
                                    ->id, 'sens_inverse' => 0, 'annulee' => 0],
                ['date' => '2016-05-22', 'trophee_id' => $trophe_2016, 'circuit_id' => DB::table('circuits')
                                    ->select('id')
                                    ->where('nom', 'Val d\'Argenton')
                                    ->first()
                                    ->id, 'sens_inverse' => 0, 'annulee' => 0],
                ['date' => '2016-06-12', 'trophee_id' => $trophe_2016, 'circuit_id' => DB::table('circuits')
                                    ->select('id')
                                    ->where('nom', 'St Genis de Saintonge')
                                    ->first()
                                    ->id, 'sens_inverse' => 0, 'annulee' => 0],
                ['date' => '2016-06-26', 'trophee_id' => $trophe_2016, 'circuit_id' => DB::table('circuits')
                                    ->select('id')
                                    ->where('nom', 'Biscarrosse')
                                    ->first()
                                    ->id, 'sens_inverse' => 0, 'annulee' => 0],
                ['date' => '2016-09-04', 'trophee_id' => $trophe_2016, 'circuit_id' => DB::table('circuits')
                                    ->select('id')
                                    ->where('nom', 'Teyjat Nontron')
                                    ->first()
                                    ->id, 'sens_inverse' => 0, 'annulee' => 0],
                ['date' => '2016-09-18', 'trophee_id' => $trophe_2016, 'circuit_id' => DB::table('circuits')
                                    ->select('id')
                                    ->where('nom', 'St Genis de Saintonge')
                                    ->first()
                                    ->id, 'sens_inverse' => 0, 'annulee' => 0],
                ['date' => '2016-10-02', 'trophee_id' => $trophe_2016, 'circuit_id' => DB::table('circuits')
                                    ->select('id')
                                    ->where('nom', 'Pau Lescar')
                                    ->first()
                                    ->id, 'sens_inverse' => 0, 'annulee' => 0],
                ['date' => '2016-10-16', 'trophee_id' => $trophe_2016, 'circuit_id' => DB::table('circuits')
                                    ->select('id')
                                    ->where('nom', 'Biscarrosse')
                                    ->first()
                                    ->id, 'sens_inverse' => 1, 'annulee' => 0],
                ['date' => '2016-11-06', 'trophee_id' => $trophe_2016, 'circuit_id' => DB::table('circuits')
                                    ->select('id')
                                    ->where('nom', 'Layrac')
                                    ->first()
                                    ->id, 'sens_inverse' => 0, 'annulee' => 0],
        );
            
        // Loop through each user above and create the record for them in the database
        foreach ($courses as $course)
        {
            Course::create($course);
        }

        Model::reguard();
    }
}
