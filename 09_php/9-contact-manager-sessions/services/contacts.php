<?php

function findAllContacts(?string $filter = null) {
    $contacts = $_SESSION['contacts'] ?? [];

    if ($filter) {
        return array_filter($contacts, function($contact) use ($filter) {
            return stripos($contact['name'], $filter) !== false || stripos($contact['email'], $filter) !== false;
        });
    }
    
    return $contacts;
}

function findContactById(string $id) {
    $contacts = findAllContacts();
    return $contacts[$id] ?? null;
}

function createContact(array $data) {
    $id = uniqid();
    $contact = [
        'id' => $id,
        ...$data,
        'createdAt' => time(),
        'updatedAt' => time(),
    ];
    $_SESSION['contacts'][$id] = $contact;

    return $contact;
}

function updateContact(string $id, array $data) {
    $contact = findContactById($id);

    if (!$contact) {
        return null;
    }

    $updatedContact = [
        ...$contact,
        ...$data,
        'updatedAt' => time(),
    ];
    $_SESSION['contacts'][$id] = $updatedContact;

    return $updatedContact;
}

function deleteContact(string $id) {
    unset($_SESSION['contacts'][$id]);
}
