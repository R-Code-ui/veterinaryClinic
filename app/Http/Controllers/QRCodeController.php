<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRCodeController extends Controller
{
    // Download QR as SVG (for admin side)
    public function downloadAdminPng(Pet $pet)
    {
        // Generate SVG content (no Imagick needed)
        $svgContent = QrCode::size(300)
            ->generate(route('admin.pets.show', $pet->id));

        return response($svgContent)
            ->header('Content-Type', 'image/svg+xml')
            ->header('Content-Disposition', 'attachment; filename="qrcode_pet_' . $pet->id . '.svg"');
    }

    // Download QR as SVG (for client side)
    public function downloadClientPng(Pet $pet)
    {
        $svgContent = QrCode::size(300)
            ->generate(route('client.pets.show', $pet->id));

        return response($svgContent)
            ->header('Content-Type', 'image/svg+xml')
            ->header('Content-Disposition', 'attachment; filename="qrcode_pet_' . $pet->id . '.svg"');
    }
}
