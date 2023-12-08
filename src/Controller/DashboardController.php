<?php

namespace App\Controller;

use App\Repository\SlotRepository;
use Symfony\UX\Chartjs\Model\Chart;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(
        SlotRepository $slotRepository,
        ChartBuilderInterface $chartBuilder
    ): Response {


        $rawData = $slotRepository->findAll();

        $data = [];
        foreach ($rawData as $date) {
            $data['time'][] = $date->getTotalTime();
            $data['date'][] = $date->getDate()->format('d/m');
        }

        $chart = $chartBuilder->createChart(Chart::TYPE_LINE);

        $chart->setData([
            'labels' => $data['date'],
            'datasets' => [
                [
                    'label' => 'Sleeping time',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => $data['time']
                ],
            ],
        ]);

        $chart->setOptions([
            'scales' => [
                'y' => [
                    'suggestedMin' => 0,
                    'suggestedMax' => 700,
                ],
            ],
        ]);

        return $this->render('dashboard/index.html.twig', [
            'chart' => $chart,
        ]);
    }
}
