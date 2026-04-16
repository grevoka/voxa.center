<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class RolePermission extends Model
{
    public $timestamps = false;

    protected $fillable = ['role', 'section'];

    const SECTIONS = [
        'dashboard' => ['label' => 'Tableau de bord', 'icon' => 'bi-grid-1x2-fill'],
        'analytics' => ['label' => 'Statistiques', 'icon' => 'bi-graph-up'],
        'contacts' => ['label' => 'Demandes de contact', 'icon' => 'bi-envelope-fill'],
        'users' => ['label' => 'Utilisateurs', 'icon' => 'bi-people-fill'],
        'files' => ['label' => 'Fichiers partages', 'icon' => 'bi-folder2-open'],
        'calendar' => ['label' => 'Calendrier RDV', 'icon' => 'bi-calendar3'],
        'schedule' => ['label' => 'Horaires', 'icon' => 'bi-clock-history'],
        'smtp' => ['label' => 'Serveur SMTP', 'icon' => 'bi-envelope-at-fill'],
        'password' => ['label' => 'Mon mot de passe', 'icon' => 'bi-key-fill'],
    ];

    public static function hasAccess(string $role, string $section): bool
    {
        if ($role === User::ROLE_ADMIN) {
            return true;
        }

        return in_array($section, self::getSectionsForRole($role));
    }

    public static function getSectionsForRole(string $role): array
    {
        if ($role === User::ROLE_ADMIN) {
            return array_keys(self::SECTIONS);
        }

        return Cache::remember("permissions.{$role}", 300, function () use ($role) {
            return self::where('role', $role)->pluck('section')->toArray();
        });
    }

    public static function syncRole(string $role, array $sections): void
    {
        self::where('role', $role)->delete();

        foreach ($sections as $section) {
            self::create(['role' => $role, 'section' => $section]);
        }

        Cache::forget("permissions.{$role}");
    }
}
