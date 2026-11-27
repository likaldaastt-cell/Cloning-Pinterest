public function toArray(Request $request): array
{
    return [
        'id' => $this->id,
        'title' => $this->title,
        'description' => $this->description,
        'image_url' => $this->image_url,
        'category' => $this->category,
        'board_id' => $this->board_id,
        'user' => $this->whenLoaded('user', fn () => [
            'id' => $this->user->id,
            'name' => $this->user->name,
        ]),
        'likes_count' => $this->whenCounted('likedBy'),
        'liked_by_me' => $this->when(isset($this->liked_by_me), fn () => (bool) $this->liked_by_me),
        'created_at' => $this->created_at,
    ];
}