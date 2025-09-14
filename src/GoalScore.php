<?php


declare(strict_types=1);

namespace Luptowski\PhpMpc;

use PhpMcp\Server\Attributes\McpTool;

class GoalScore
{
    private array $db;

    public function __construct()
    {
        $json = file_get_contents(__DIR__ . "/../data/players.json");
        $this->db = json_decode($json, true);
    }

    #[McpTool(name: 'search_players')]
    public function find(string $fullName): array
    {
        $player = array_filter($this->db, fn ($player) => $player['fullName'] === $fullName);
        
        if (empty($player)) {
            throw new \RuntimeException("Player not found: {$fullName}");
        }
        
        return array_values($player);
    }
}
