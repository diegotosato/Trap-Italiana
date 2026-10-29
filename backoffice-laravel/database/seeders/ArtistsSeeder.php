<?php

namespace Database\Seeders;

use App\Models\Artist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArtistsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $artists = [
            [
                'name' => 'Lazza',
                'slug' => Str::slug('Lazza'),
                'spotify_id' => '0jdNdfi4vAuVi7a6cPDFBM',
                'image_url' => 'https://i.scdn.co/image/ab6761610000e5eba6fa9c526ac155d3dc888c25',
                'description' => 'Lazza, nome d\'arte di Jacopo Lazzarini, è uno dei rapper più tecnici e prolifici della scena italiana. Cresciuto tra Milano e il panorama underground, ha conquistato il mainstream con un flow preciso e testi di rara profondità, diventando un simbolo della nuova leva rap italiana.',
            ],
            [
                'name' => 'Marracash',
                'slug' => Str::slug('Marracash'),
                'spotify_id' => '5AZuEF0feCXMkUCwQiQlW7',
                'image_url' => 'https://i.scdn.co/image/ab6761610000f1788aa0ff279be0623fce3e6c9d',
                'description' => 'Marracash, nome d\'arte di Fabio Bartolo Rizzo, è considerato il re dell\'hip hop italiano. Con una carriera ventennale alle spalle, ha saputo evolversi senza mai tradire le proprie radici, consacrando la sua arte con album che hanno ridefinito gli standard del genere nel nostro Paese.',
            ],
            [
                'name' => 'Salmo',
                'slug' => Str::slug('Salmo'),
                'spotify_id' => '3hBQ4zniNdQf1cqqo6hzuW',
                'image_url' => 'https://i.scdn.co/image/ab6761610000e5ebb7ee3fb6650d358fa6a95f98',
                'description' => 'Salmo, nome d\'arte di Maurizio Pisciottu, è un artista sardo che ha saputo fondere trap, hip hop e influenze elettroniche in un suono unico. Visionario e provocatorio, è noto tanto per la sua musica quanto per i live show esplosivi che lo hanno reso una vera e propria forza della natura sulla scena italiana.',
            ],
            [
                'name' => 'Jake La Furia',
                'slug' => Str::slug('Jake La Furia'),
                'spotify_id' => '6JFRI91YaCXREGQYzHSnUH',
                'image_url' => 'https://i.scdn.co/image/ab6761610000e5eb25dbfdbc166a10d8d378adf0',
                'description' => 'Jake La Furia, nome d\'arte di Francesco Cozzi, è uno dei volti storici del rap milanese. Membro fondatore dei Club Dogo insieme a Gue Pequeno e Don Joe, ha costruito la sua carriera su rime taglienti e un\'identità autentica che lo ha reso un punto di riferimento indiscusso per l\'hip hop made in Italy.',
            ],
            [
                'name' => 'Emis Killa',
                'slug' => Str::slug('Emis Killa'),
                'spotify_id' => '6FtwCmLY6L1sqvjaQ2lV6G',
                'image_url' => 'https://i.scdn.co/image/ab6761610000e5eba173f6ae80762b9d1c1632e5',
                'description' => 'Emis Killa, nome d\'arte di Emiliano Rudolf Giambelli, è uno dei rapper più rappresentativi della sua generazione. Con uno stile diretto e una penna affilata, ha saputo conquistare sia il pubblico underground che quello mainstream, affermandosi come una delle voci più riconoscibili del rap italiano.',
            ],
            [
                'name' => 'Anna',
                'slug' => Str::slug('Anna'),
                'spotify_id' => '7K80yOTC0Id95gRaOxDG5u',
                'image_url' => 'https://i.scdn.co/image/ab6761610000e5eb16ee63e6124b1f5ad58c6b35',
                'description' => 'Anna, nome d\'arte di Anna Pepe, è la giovane regina della trap italiana. Nata a Ferrara nel 2002, ha conquistato il pubblico con un flow istintivo e testi in cui parla senza filtri della sua generazione, diventando in pochi anni uno dei volti più freschi e influenti della scena rap femminile italiana.',
            ],
            [
                'name' => 'Artie 5ive',
                'slug' => Str::slug('Artie 5ive'),
                'spotify_id' => '2R4kNOwHUUsuDYhKsESVbF',
                'image_url' => 'https://i.scdn.co/image/ab6761610000e5eb497c296b3d4b239cf30f458f',
                'description' => 'Artie 5ive, nome d\'arte di Arturo Sperandio, è un rapper romano che ha saputo ritagliarsi un posto di rilievo nella trap italiana grazie a un suono melodico e una presenza scenica magnetica. Con collaborazioni eccellenti e hit di successo, rappresenta una delle nuove promesse più interessanti della scena.',
            ],
            [
                'name' => 'Sfera Ebbasta',
                'slug' => Str::slug('Sfera Ebbasta'),
                'spotify_id' => '23TFHmajVfBtlRx5MXqgoz',
                'image_url' => 'https://i.scdn.co/image/ab6761610000e5eb21b75feae67bdf60ecf2eed2',
                'description' => 'Sfera Ebbasta, nome d\'arte di Gionata Boschetti, è uno dei pionieri della trap italiana. Dal 2015 ha rivoluzionato la scena con il suo stile inconfondibile, diventando un punto di riferimento per tutta la nuova generazione.',
            ],
            [
                'name' => 'Shiva',
                'slug' => Str::slug('Shiva'),
                'spotify_id' => '2K5nCggbhSZ00YCYP5qkZS',
                'image_url' => 'https://i.scdn.co/image/ab6761610000e5ebaef53e971834894d112256a6',
                'description' => 'Shiva, nome d\'arte di Andreas Arrigoni, è uno dei rapper più in ascesa della scena milanese. Con un flow veloce e preciso e testi che raccontano la vita di strada con autenticità brutale, si è imposto come uno dei nomi più caldi della nuova trap italiana, guadagnando rispetto sia nell\'underground che nel mainstream.',
            ],
            [
                'name' => 'Ernia',
                'slug' => Str::slug('Ernia'),
                'spotify_id' => '3fhMfkPPzksWuw0hEm4ldm',
                'image_url' => 'https://i.scdn.co/image/ab6761610000e5eb2a0ccee58751efd0729d8129',
                'description' => 'Ernia, nome d\'arte di Matteo Professione, è uno dei rapper milanesi più apprezzati della scena contemporanea. Con testi introspettivi, un approccio cinematografico alla narrazione e un\'estetica curata, ha costruito un\'identità artistica distintiva che lo separa dalla massa e lo rende uno degli artisti più interessanti del panorama italiano.',
            ],
            [
                'name' => 'Capo Plaza',
                'slug' => Str::slug('Capo Plaza'),
                'spotify_id' => '5SulO4l40qDuV9zUGLZx7n',
                'image_url' => 'https://i.scdn.co/image/ab6761610000e5ebb3df18f1cf89650d6ddaa534',
                'description' => 'Capo Plaza, nome d\'arte di Luca D\'Orso, è un rapper campano originario di Salerno che ha conquistato le classifiche italiane con la sua trap melodica. Lanciato giovanissimo accanto a Sfera Ebbasta, ha dimostrato una maturità artistica fuori dal comune, affermandosi come uno degli esponenti di punta della nuova generazione trap.',
            ],
        ];

        foreach ($artists as $artist) {
            Artist::create($artist);
        }
    }
}
