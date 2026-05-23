@props(['status', 'type' => 'property'])

@php
    $getStatusData = function($status, $type) {
        $status = strtolower($status);
        
        // Property Statuses
        if ($type === 'property') {
            return match($status) {
                'available' => [
                    'class' => 'bg-success text-white', 
                    'style' => 'background-color: #2F4F3E !important;',
                    'label' => 'Available'
                ],
                'under_negotiation' => [
                    'class' => 'bg-warning text-dark', 
                    'style' => 'background-color: #C8A96A !important; color: #fff !important;',
                    'label' => 'Under Negotiation'
                ],
                'reserved' => [
                    'class' => 'bg-info text-white', 
                    'style' => 'background-color: #1a2e24 !important;',
                    'label' => 'Reserved'
                ],
                'sold' => [
                    'class' => 'bg-danger text-white', 
                    'style' => 'background-color: #842029 !important;',
                    'label' => 'Sold'
                ],
                default => [
                    'class' => 'bg-secondary text-white', 
                    'style' => '',
                    'label' => ucfirst(str_replace('_', ' ', $status))
                ]
            };
        }

        // Image Statuses
        if ($type === 'image') {
            return match($status) {
                'main', '1', 'true' => [
                    'class' => 'bg-warning text-white', 
                    'style' => 'background-color: #C8A96A !important;',
                    'label' => 'Main Image'
                ],
                'gallery', '0', 'false' => [
                    'class' => 'bg-light text-dark border', 
                    'style' => 'background-color: #F5F2EC !important; color: #2F4F3E !important; border: 1px solid #e0d8c3 !important;',
                    'label' => 'Gallery'
                ],
                default => [
                    'class' => 'bg-secondary text-white', 
                    'style' => '',
                    'label' => ucfirst($status)
                ]
            };
        }

        // Visit/Offer/Deposit Statuses
        return match($status) {
            'pending' => [
                'class' => 'text-white', 
                'style' => 'background-color: #C8A96A !important;',
                'label' => 'Pending'
            ],
            'approved', 'completed', 'active' => [
                'class' => 'text-white', 
                'style' => 'background-color: #2F4F3E !important;',
                'label' => ucfirst($status)
            ],
            'rejected', 'cancelled', 'refunded' => [
                'class' => 'text-white', 
                'style' => 'background-color: #842029 !important;',
                'label' => ucfirst($status)
            ],
            default => [
                'class' => 'bg-secondary text-white', 
                'style' => '',
                'label' => ucfirst($status)
            ]
        };
    };

    $data = $getStatusData($status, $type);
@endphp

<span class="status-badge {{ $data['class'] }} shadow-sm" style="{{ $data['style'] }} font-size: 0.7rem; letter-spacing: 0.5px; border-radius: 6px; padding: 5px 10px;">
    {{ strtoupper($data['label']) }}
</span>

<style>
    @once
    .status-badge {
        display: inline-flex;
        align-items: center;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        transition: all 0.2s ease-in-out;
    }
    .status-badge:hover {
        transform: scale(1.05);
    }
    @endonce
</style>
