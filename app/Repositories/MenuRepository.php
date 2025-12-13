<?php

namespace App\Repositories;

use App\Models\Menu;
use App\Models\MenuGroup;
use Illuminate\Database\Eloquent\Collection;

class MenuRepository extends Repository
{

    /**
     * constructor method
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = new Menu();
    }

    /**
     * getMenus
     *
     * @return Collection
     */
    public function getMenus()
    {
        return MenuGroup::query()->with(['menus'])->get();
    }

    /**
     * getFullData
     *
     * @return Collection
     */
    public function getFullData()
    {
        return $this->model->with(['group', 'parentMenu', 'childs'])->get();
    }

    /**
     * Create a new menu record.
     *
     * @param array $data
     * @return \App\Models\Menu
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update an existing menu record.
     *
     * @param array $data
     * @param int $id
     * @return \App\Models\Menu
     */
    // PERBAIKAN: Tambahkan parameter $columns agar kompatibel dengan kelas Repository induk
    public function update(array $data, int $id, array $columns = ['*'])
    {
        $menu = $this->model->findOrFail($id);
        $menu->update($data);
        return $menu;
    }

    /**
     * Delete a menu record.
     *
     * @param int $id
     * @return bool|null
     */
    public function delete(int $id)
    {
        $menu = $this->model->findOrFail($id);
        return $menu->delete();
    }
}
