<?php

namespace App\Filament\Owner\Widgets;

use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Schema;
use Filament\Widgets\ChartWidget;
use App\Models\Order;

class StationOnBoardChart extends ChartWidget
{
    use ChartWidget\Concerns\HasFiltersSchema;
    protected ?array $options = [
        'plugins' => [
            'legend' => [
                'display' => false,
            ],
        ],
    ];

    protected ?string $heading = 'Order On Statistic Chart';

    public function getDescription(): ?string
    {
        return 'The number of orders the system recorded.';
    }

    protected function getData(): array
    {
        $year = $this->filters['year'] ?? now()->year;

        $data = Order::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $monthlyData = [];

        for ($i = 1; $i <= 12; $i++) {
            $monthlyData[] = $data[$i] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Order On Statistic',
                    'data' => $monthlyData
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
        ];
    }

    public function filtersSchema(Schema $schema): Schema
    {
        return $schema->components([
            DatePicker::make('year')
                ->native(false)
                ->displayFormat('Y')
                ->format('Y')
                ->default(now()->year),
        ]);
    }
}
