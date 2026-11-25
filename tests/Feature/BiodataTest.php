<?php

use App\Models\Biodata;
use Database\Seeders\BiodataSeeder;

test('home page renders exact layout and seeded biodata cards', function () {
    $this->seed(BiodataSeeder::class);

    $response = $this->get(route('home'));

    $response->assertOk()
        ->assertSee('UTS Pem Web')
        ->assertSee('(Bagus Zyga Wirawan dan IKLIMAH)')
        ->assertSee('(24010110193 dan 24010110234)')
        ->assertSee('Biodata berhasil diperbarui.')
        ->assertSee('Bagus Zyga Wirawan')
        ->assertSee('images/zyga.jpeg')
        ->assertSee('24010110193 merupakan master dari uts ini dengan tugas membuat front-end dan mengirimkannya ke grup')
        ->assertSee('IKLIMAH')
        ->assertSee('images/ima.jpeg')
        ->assertSee('dengan NIM 24010110234 merupakan pegawai dan mempunyai tugas mengerjakan back-end pada UTS ini')
        ->assertSee('Dibuat Sejujurjurnya Oleh Team (Bagus Zyga Wirawan) dan (IKLIMAH) Tanpa Mencotek dari Tim Lain');
});

test('can create, update, and delete biodata', function () {
    $storeResponse = $this->post(route('biodata.store'), [
        'nama' => 'budi santoso',
        'deskripsi' => '12.11.9999 anggota baru',
    ]);

    $storeResponse->assertRedirect(route('home'));
    $biodata = Biodata::where('nama', 'budi santoso')->first();
    expect($biodata)->not->toBeNull();

    $updateResponse = $this->put(route('biodata.update', $biodata), [
        'nama' => 'budi santoso updated',
        'deskripsi' => '12.11.9999 deskripsi baru',
    ]);

    $updateResponse->assertRedirect(route('home'))
        ->assertSessionHas('success', 'Biodata berhasil diperbarui.');
    expect($biodata->fresh()->nama)->toBe('budi santoso updated');

    $deleteResponse = $this->delete(route('biodata.destroy', $biodata));

    $deleteResponse->assertRedirect(route('home'));
    expect(Biodata::find($biodata->id))->toBeNull();
});
