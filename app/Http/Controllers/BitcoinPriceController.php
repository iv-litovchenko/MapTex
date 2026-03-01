<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

/**
 * Контроллер для получения цены биткоина
 */
class BitcoinPriceController extends BaseController
{
    /**
     * Получить текущую цену биткоина
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        try {
            $priceData = $this->getBitcoinPrice();

            // Если запрос через AJAX или с параметром json, возвращаем JSON
            if ($request->wantsJson() || $request->input('format') === 'json') {
                return response()->json($priceData);
            }

            // Иначе возвращаем view
            return view('site.bitcoin-price', compact('priceData'));
        } catch (\Exception $e) {
            if ($request->wantsJson() || $request->input('format') === 'json') {
                return response()->json([
                    'error' => 'Не удалось получить цену биткоина',
                    'message' => $e->getMessage()
                ], 500);
            }

            return view('site.bitcoin-price', [
                'error' => 'Не удалось получить цену биткоина: ' . $e->getMessage(),
                'priceData' => null
            ]);
        }
    }

    /**
     * Получить цену биткоина через API
     *
     * @return array
     * @throws \Exception
     */
    protected function getBitcoinPrice()
    {
        // Кэшируем на 1 минуту, чтобы не делать слишком много запросов
        return Cache::remember('bitcoin_price', 60, function () {
            // Используем CoinGecko API (бесплатный, не требует регистрации)
            $response = Http::timeout(10)->get('https://api.coingecko.com/api/v3/simple/price', [
                'ids' => 'bitcoin',
                'vs_currencies' => 'usd,eur,rub',
                'include_24hr_change' => 'true',
                'include_24hr_vol' => 'true',
                'include_market_cap' => 'true'
            ]);

            if (!$response->successful()) {
                throw new \Exception('API недоступен');
            }

            $data = $response->json();

            if (!isset($data['bitcoin'])) {
                throw new \Exception('Данные о биткоине не найдены');
            }

            $bitcoin = $data['bitcoin'];

            return [
                'usd' => [
                    'price' => number_format($bitcoin['usd'], 2, '.', ' '),
                    'change_24h' => isset($bitcoin['usd_24h_change']) ? round($bitcoin['usd_24h_change'], 2) : null,
                ],
                'eur' => [
                    'price' => number_format($bitcoin['eur'], 2, '.', ' '),
                    'change_24h' => isset($bitcoin['eur_24h_change']) ? round($bitcoin['eur_24h_change'], 2) : null,
                ],
                'rub' => [
                    'price' => number_format($bitcoin['rub'], 2, '.', ' '),
                    'change_24h' => isset($bitcoin['rub_24h_change']) ? round($bitcoin['rub_24h_change'], 2) : null,
                ],
                'volume_24h' => isset($bitcoin['usd_24h_vol']) ? number_format($bitcoin['usd_24h_vol'], 0, '.', ' ') : null,
                'market_cap' => isset($bitcoin['usd_market_cap']) ? number_format($bitcoin['usd_market_cap'], 0, '.', ' ') : null,
                'updated_at' => now()->format('d.m.Y H:i:s'),
            ];
        });
    }

    /**
     * Получить историю цен (за последние 7 дней)
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function history(Request $request)
    {
        try {
            $days = $request->input('days', 7);
            $currency = $request->input('currency', 'usd');

            $cacheKey = "bitcoin_history_{$days}_{$currency}";
            
            $history = Cache::remember($cacheKey, 300, function () use ($days, $currency) {
                $response = Http::timeout(10)->get("https://api.coingecko.com/api/v3/coins/bitcoin/market_chart", [
                    'vs_currency' => $currency,
                    'days' => $days
                ]);

                if (!$response->successful()) {
                    throw new \Exception('API недоступен');
                }

                return $response->json();
            });

            return response()->json($history);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Не удалось получить историю цен',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
