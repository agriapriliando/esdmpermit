<?php

namespace App\Jobs;

use App\Mail\AktivasiAkun;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendActivationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected int $userId;
    protected string $password;
    protected string $url;

    /**
     * Buat job baru.
     *
     * @param int $userId
     * @param string $password
     * @param string $url
     */
    public function __construct(int $userId, string $password, string $url)
    {
        $this->userId   = $userId;
        $this->password = $password;
        $this->url      = $url;
    }

    /**
     * Jalankan job.
     */
    public function handle(): void
    {
        // Ambil user fresh dari DB
        $user = User::find($this->userId);

        if (!$user) {
            Log::warning("Job SendActivationEmail: User dengan ID {$this->userId} tidak ditemukan, email tidak dikirim.");
            return;
        }

        // Kirim email aktivasi
        Mail::to($user->email)->send(
            new AktivasiAkun(
                $user->name,
                $user->username,
                $this->password,
                $this->url
            )
        );

        Log::info("Job SendActivationEmail: Email aktivasi berhasil dikirim ke {$user->email}.");
    }
}
