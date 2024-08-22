<?php

namespace App\Http\Traits;

trait I18n
{
    public function i18n()
    {
        return $this->hasOne($this->getI18nModel())->where('language_id', session()->get('langId', 1));
    }

    public function i18nAll()
    {
        return $this->hasMany($this->getI18nModel());
    }

    private function getI18nModel()
    {
        return get_class($this) . '_i18n';
    }

    public function i18nWithTrashed()
    {
        return $this->hasMany($this->getI18nModel())->withTrashed();
    }

    public function i18nAdmin()
    {
        $results = [];
        $i18n = $this->hasMany($this->getI18nModel())->get();
        if ($i18n->count()) {
            foreach ($i18n as $row) {
                $results[$row->language_id] = (object) $row;
            }
        }

        return $results;
    }

}
