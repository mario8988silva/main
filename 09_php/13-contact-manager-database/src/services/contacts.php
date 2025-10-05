<?php

require_once '../src/services/authentication.php';
require_once '../src/core/database.php';

function findAllContacts(?string $filter = null) {
    $user = isAuthenticated();
    $connection = getConnection();
    $sql = "SELECT * FROM friends WHERE user_id = :user_id AND (name LIKE :filter OR email LIKE :filter OR phone LIKE :filter) ORDER BY created_at DESC";

    $stmt = $connection->prepare($sql);
    $stmt->execute([
        'user_id' => $user->id,
        'filter' => "%$filter%"
    ]);

    return $stmt->fetchAll();
}

function findContactById(string $id) {
    $user = isAuthenticated();
    $connection = getConnection();
    $sql = "SELECT * FROM friends WHERE user_id = :user_id AND id = :id LIMIT 1";

    $stmt = $connection->prepare($sql);
    $stmt->execute([
        'user_id' => $user->id,
        'id' => $id
    ]);

    return $stmt->fetch();
}

function createContact(string $name, string $email, string $phone, ?array $photo = null) {
    $user = isAuthenticated();
    $connection = getConnection();
    $sql = "INSERT INTO friends (name, email, phone, photo, user_id) VALUES (:name, :email, :phone, :photo, :user_id)";

    $stmt = $connection->prepare($sql);
    $stmt->execute([
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'photo' => uploadPhoto($photo),
        'user_id' => $user->id,
    ]);

    return $connection->lastInsertId();
}

function updateContact(string $id, string $name, string $email, string $phone, ?array $photo = null) {
    $contact = findContactById($id);

    if (!$contact) {
        return null;
    }

    if ($photo['name'] !== '') {
        $imagePath = uploadPhoto($photo);

        if (file_exists($contact->photo)) {
            unlink($contact->photo);
        }
    }

    $user = isAuthenticated();
    $connection = getConnection();

    $sql = "UPDATE friends SET name = :name, email = :email, phone = :phone, photo = :photo WHERE id = :id AND user_id = :user_id";
    $stmt = $connection->prepare($sql);
    $stmt->execute([
        'id' => $id,
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'photo' => $imagePath ?? $contact->photo,
        'user_id' => $user->id,
    ]);

    return $stmt->rowCount();
}

function deleteContact(string $id) {
    $contact = findContactById($id);

    if (file_exists($contact->photo)) {
        unlink($contact->photo);
    }

    $user = isAuthenticated();
    $connection = getConnection();
    $sql = "DELETE FROM friends WHERE id = :id AND user_id = :user_id";
    $stmt = $connection->prepare($sql);
    $stmt->execute([
        'id' => $id,
        'user_id' => $user->id,
    ]);
    return $stmt->rowCount();
}

function uploadPhoto(array $file): ?string {
    $fileName = md5($file['name'] . time());
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = "images/contacts/$fileName.$ext";

    if (!move_uploaded_file($file['tmp_name'], $filename)) {
        return null;
    }

    return $filename;
}
