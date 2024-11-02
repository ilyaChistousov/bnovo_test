<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CreateGuestRequest;
use App\Http\Requests\UpdateGuestRequest;
use App\Models\Guest;
use Illuminate\Http\JsonResponse;

final class GuestController extends Controller
{
    public function index(): JsonResponse
    {
        $guests = Guest::all();

        return response()->json($guests);
    }

    public function show(int $id): JsonResponse
    {
        $guest = Guest::query()->findOrFail($id);

        return response()->json($guest);
    }
    public function store(CreateGuestRequest $request): JsonResponse
    {
        $data = $request->validated();

        if (empty($data['country'])) {
            $data['country'] = $this->getCountryFromPhoneNumber($data['phone']);
        }

        $guest = Guest::query()->create($data);

        return response()->json($guest, 201);
    }

    public function update(UpdateGuestRequest $request, int $id): JsonResponse
    {
        $guest = Guest::query()->findOrFail($id);

        $data = $request->validated();

        $guest->update($data);

        return response()->json($guest);
    }

    public function destroy(int $id): JsonResponse
    {
        $guest = Guest::query()->findOrFail($id);
        $guest->delete();

        return response()->json(['success' => true], 204);
    }

    private function getCountryFromPhoneNumber(string $phone): ?string
    {
        $countries = config('countries_phone');

        foreach ($countries as $code => $country) {
            if (str_starts_with($phone, $code)) {
                return $country;
            }
        }

        return null;
    }
}
