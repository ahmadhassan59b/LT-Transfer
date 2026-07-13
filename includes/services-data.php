<?php
/**
 * LT TRANSFERS — WEBSITE
 * includes/services-data.php
 *
 * Single source of truth for every resort / situation-specific
 * service page. Adding a new page is as simple as adding a new
 * array entry here — service.php renders it automatically and
 * services.php lists it on the overview grid.
 *
 * Each slug matches the pretty URL used in the new design and
 * routed by .htaccess (e.g. /disney-vacation-club-transfers/).
 *
 * Note: URL slugs are left unchanged for SEO/link stability even
 * where the on-page wording below uses "document" / "timeshare
 * transfer required forms" instead of "deed".
 */

declare(strict_types=1);

return [
    'disney-vacation-club-transfers' => [
        'title'        => 'Disney Vacation Club Transfers',
        'short'        => 'Disney Vacation Club Transfers',
        'meta'         => 'Document preparation and recording for Disney Vacation Club (DVC) timeshare transfers, including adding family members and resale transfers.',
        'eyebrow'      => 'Resort-specific transfer service',
        'intro'        => 'Disney Vacation Club transfers involve resort-specific paperwork and notification steps. LT Transfers prepares the transfer document, handles recording where required, and notifies DVC Member Administration once the transfer is complete.',
        'points'       => [
            'Document preparation for DVC resale and family transfers',
            'Support for adding a spouse, child, or family member to an existing membership',
            'Coordination with DVC Member Administration after signing',
            'Guidance on required documents if your original membership paperwork is missing',
        ],
    ],
    'wyndham-transfers' => [
        'title'        => 'Wyndham Transfers',
        'short'        => 'Wyndham Transfers',
        'meta'         => 'Timeshare transfer document preparation for Wyndham deeded and points-based ownership changes.',
        'eyebrow'      => 'Resort-specific transfer service',
        'intro'        => 'Wyndham ownership changes vary between deeded weeks and points-based contracts. LT Transfers reviews your current documents and prepares the correct transfer paperwork for your specific Wyndham product.',
        'points'       => [
            'Document preparation for deeded Wyndham weeks',
            'Assistance identifying the correct transfer process for points-based contracts',
            'County recording where applicable',
            'Resort notification after the transfer is recorded',
        ],
    ],
    'marriott-vacation-club-transfers' => [
        'title'        => 'Marriott Vacation Club Transfers',
        'short'        => 'Marriott Vacation Club Transfers',
        'meta'         => 'Transfer document preparation and resort notification for Marriott Vacation Club owners nationwide.',
        'eyebrow'      => 'Resort-specific transfer service',
        'intro'        => 'LT Transfers has prepared transfer documents for many Marriott Vacation Club resorts, including Grande Ocean, Grande Vista, Maui Ocean Club, Custom House, and Newport Coast. We handle the paperwork so the resort receives a clean, complete transfer package.',
        'points'       => [
            'Document preparation for Marriott Vacation Club weeks and points',
            'Experience with a wide range of Marriott resort locations',
            'County recording where applicable',
            'Resort notification after signing',
        ],
    ],
    'hilton-grand-vacations-transfers' => [
        'title'        => 'Hilton Grand Vacations Transfers',
        'short'        => 'Hilton Grand Vacations Transfers',
        'meta'         => 'Timeshare transfer services for Hilton Grand Vacations (HGV) owners, including document preparation and resort notification.',
        'eyebrow'      => 'Resort-specific transfer service',
        'intro'        => 'Hilton Grand Vacations transfers are prepared to meet HGV documentation requirements. LT Transfers manages transfer document preparation, recording, and resort notification so your ownership change is processed correctly the first time.',
        'points'       => [
            'Document preparation for HGV deeded ownership',
            'County recording where applicable',
            'Resort notification once documents are recorded',
            'Support for family transfers and resale closings',
        ],
    ],
    'hyatt-residence-club-transfers' => [
        'title'        => 'Hyatt Residence Club Transfers',
        'short'        => 'Hyatt Residence Club Transfers',
        'meta'         => 'Document preparation and resort coordination for Hyatt Residence Club timeshare transfers.',
        'eyebrow'      => 'Resort-specific transfer service',
        'intro'        => 'LT Transfers regularly prepares transfer documents for Hyatt Residence Club properties, including Sunset Harbor and Windward Pointe. We prepare the transfer document, coordinate recording, and notify the resort once the transfer is finalized.',
        'points'       => [
            'Document preparation for Hyatt Residence Club ownership',
            'County recording where applicable',
            'Resort notification after the transfer is complete',
            'Assistance locating your ownership document if it has been misplaced',
        ],
    ],
    'vistana-transfers' => [
        'title'        => 'Vistana Transfers',
        'short'        => 'Vistana Transfers',
        'meta'         => 'Timeshare transfer document preparation for Vistana Signature Experiences resorts.',
        'eyebrow'      => 'Resort-specific transfer service',
        'intro'        => 'LT Transfers has prepared transfers for numerous Vistana resorts, including Sheraton and Westin-affiliated properties such as Harborside, Kaui Beach Club, and Aruba Ocean Club and Surf Club. We manage the transfer document preparation and resort notification process from start to finish.',
        'points'       => [
            'Document preparation for Vistana Signature Experiences properties',
            'Experience across many Sheraton and Westin resort locations',
            'County recording where applicable',
            'Resort notification once your transfer is recorded',
        ],
    ],
    'trust-transfers' => [
        'title'        => 'Trust Transfers',
        'short'        => 'Trust Transfers',
        'meta'         => 'Transfer a timeshare into a living trust with document preparation guidance from LT Transfers.',
        'eyebrow'      => 'Ownership situation',
        'intro'        => 'Moving a timeshare into a trust is a common estate-planning step. LT Transfers prepares the transfer document moving ownership into your trust and will need a copy of your trust document to complete the paperwork correctly.',
        'points'       => [
            'Document preparation to transfer ownership into an existing trust',
            'Guidance on the trust documentation needed to complete the transfer',
            'County recording where applicable',
            'Resort notification once the transfer is recorded',
        ],
    ],
    'adding-children-to-timeshare-deeds' => [
        'title'        => 'Adding Children to Timeshare Transfer Documents',
        'short'        => 'Adding Children to Timeshare Documents',
        'meta'         => 'Add an adult child or family member to your timeshare ownership document with help from LT Transfers.',
        'eyebrow'      => 'Ownership situation',
        'intro'        => 'Many owners want to add an adult child to their timeshare ownership document to simplify estate planning or share future use. LT Transfers can add a child of legal age to your existing document and handle the required recording and resort notification.',
        'points'       => [
            'Document preparation to add a child or family member of legal age',
            'County recording where applicable',
            'Resort notification once the updated document is recorded',
            'Guidance on next steps if your child is a minor',
        ],
    ],
    'timeshare-inheritance-transfers' => [
        'title'        => 'Timeshare Inheritance Transfers',
        'short'        => 'Timeshare Inheritance Transfers',
        'meta'         => 'Transfer an inherited timeshare into the name of the new owner with LT Transfers.',
        'eyebrow'      => 'Ownership situation',
        'intro'        => 'When a timeshare is inherited, the ownership document typically needs to be updated to reflect the new owner. LT Transfers reviews the estate documentation you have available and prepares the transfer paperwork required to complete the ownership change.',
        'points'       => [
            'Document preparation for inherited timeshare ownership',
            'Guidance on the estate documents typically required',
            'County recording where applicable',
            'Resort notification once the transfer is recorded',
        ],
    ],
];
