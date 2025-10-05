<?php

require_once '../services/authentication.php';

function findAllContacts(?string $filter = null) {
    $files = glob('../data/contacts/*');
    $contacts = array_map(fn($file) => unserialize(file_get_contents($file)), $files);

    if ($filter) {
        return array_filter($contacts, function($contact) use ($filter) {
            return stripos($contact['name'], $filter) !== false || stripos($contact['email'], $filter) !== false;
        });
    }

    if (isAdmin()) {
        return $contacts;
    }

    $user = isAuthenticated();

    return array_filter($contacts, fn($contact) => $contact['user_id'] === $user['id']);
}

function findContactById(string $id) {
    $fileName = "../data/contacts/$id";
    
    if (!file_exists($fileName)) {
        return null;
    }

    $contact = unserialize(file_get_contents($fileName));

    $user = isAuthenticated();
    
    if (!isAdmin() && $contact['user_id'] !== $user['id']) {
        return null;
    }

    return $contact;
}

function createContact(string $name, string $email, string $phone, ?array $photo = null) {
    $id = uniqid();
    $user = isAuthenticated();
    $contact = [
        'id' => $id,
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'photo' => uploadPhoto($photo, $id),
        'user_id' => $user['id'],
        'createdAt' => time(),
        'updatedAt' => time(),
    ];

    saveContact($contact);
    return $contact;
}

function updateContact(string $id, string $name, string $email, string $phone, ?array $photo = null) {
    $contact = findContactById($id);

    if (!$contact) {
        return null;
    }

    if ($photo) {
        $imagePath = uploadPhoto($photo, $id);
    } else {
        $imagePath = $contact['photo'] ?? null;
    }

    $updatedContact = [
        ...$contact,
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'photo' => $imagePath,
        'updatedAt' => time(),
    ];
    
    saveContact($updatedContact);
    return $updatedContact;
}

function saveContact(array $contact) {
    file_put_contents("../data/contacts/{$contact['id']}", serialize($contact));
}

function deleteContact(string $id) {
    $filename = "../data/contacts/$id";

    $contact = findContactById($id);

    if (file_exists($contact['photo'])) {
        unlink($contact['photo']);
    }

    if (file_exists($filename)) {
        unlink($filename);
    }
    
}

function uploadPhoto(array $file, string $contactId): ?string {
    $filename = "images/contacts/$contactId.png";

    if (!move_uploaded_file($file['tmp_name'], $filename)) {
        return null;
    }

    return $filename;
}
