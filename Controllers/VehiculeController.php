<?php

namespace elitedrive\Controllers;

use elitedrive\Models\VehiculeModel;
use elitedrive\Entities\Vehicule;
use elitedrive\Models\ModeleModel;
use elitedrive\Models\MarqueModel;
use elitedrive\Models\CarburantModel;
use elitedrive\Models\TransmissionModel;
use elitedrive\Models\PlacesModel;
use elitedrive\Models\CouleurModel;
use elitedrive\Models\CategorieModel;
use elitedrive\Models\AvisModel;

class VehiculeController extends Controller
{
   public function showCar()
   {
      $vehiculeModel = new VehiculeModel();
      $categorieModel = new CategorieModel();
      $avisModel = new AvisModel();

      $categorie = $categorieModel->displayAll();
      $options = $vehiculeModel->displayOptions();

      $id_categorie = $_GET['id_categorie'] ?? null;
      $tri = $_GET['tri'] ?? null;

      $vehiculeCategorie = null;
      $vehicule = [];
      $vehiculeSearch = null;

      $isSearch = !empty($_GET['search']) || !empty($_GET['marque']) || !empty($_GET['modele']) ||
         !empty($_GET['categorie']) || !empty($_GET['carburant']) || !empty($_GET['transmission']) ||
         !empty($_GET['places']) || !empty($_GET['couleur']);

      if ($isSearch) {
         $searchCar = $_GET['search'] ?? '';
         $filterMarque = !empty($_GET['marque']) ? [$_GET['marque']] : [];
         $filterModele = !empty($_GET['modele']) ? [$_GET['modele']] : [];
         $filterCategorie = !empty($_GET['categorie']) ? [$_GET['categorie']] : [];
         $filterCarburant = !empty($_GET['carburant']) ? $_GET['carburant'] : [];
         $filterTransmission = !empty($_GET['transmission']) ? $_GET['transmission'] : [];
         $filterPlaces = !empty($_GET['places']) ? [$_GET['places']] : [];
         $filterCouleur = !empty($_GET['couleur']) ? [$_GET['couleur']] : [];

         $vehiculeSearch = $vehiculeModel->search(
            $searchCar,
            $filterModele,
            $filterMarque,
            $filterCarburant,
            $filterCategorie,
            $filterTransmission,
            $filterPlaces,
            $filterCouleur
         );
      } elseif (!empty($id_categorie)) {
         $vehiculeCategorie = $vehiculeModel->displayByCategory($id_categorie);
      } else {
         if ($tri === 'nouveaute') {
            $vehicule = $vehiculeModel->displayNew();
         } elseif ($tri === 'prix_asc') {
            $vehicule = $vehiculeModel->displayAsc();
         } elseif ($tri === 'prix_desc') {
            $vehicule = $vehiculeModel->displayDesc();
         } else {
            $vehicule = $vehiculeModel->displayAll();
         }
      }

      $notesByVehicule = [];
      $vehiculesToNote = !empty($vehiculeCategorie) ? $vehiculeCategorie : $vehicule;

      foreach ($vehiculesToNote as $v) {
         $id_vehicule = $v->id_vehicule;
         $vehiculeNotes = $avisModel->displayNoteByCar($id_vehicule);
         $moyenne = null;

         if (!empty($vehiculeNotes)) {
            $somme = array_sum($vehiculeNotes);
            $moyenne = round($somme / count($vehiculeNotes), 1);
         }

         $notesByVehicule[$id_vehicule] = $moyenne;
      }

      $this->render('vehicule/showCar', [
         'vehiculeSearch' => $vehiculeSearch,
         'vehicule' => $vehicule,
         'categorie' => $categorie,
         'notesByVehicule' => $notesByVehicule,
         'options' => $options,
         'vehiculeCategorie' => $vehiculeCategorie,
      ]);
   }







   public function showCarOne()
   {
      if (isset($_GET['id_vehicule']) && !empty($_GET['id_vehicule'])) {
         $id_vehicule = $_GET['id_vehicule'];
         $vehiculeModel = new VehiculeModel();
         $vehicule = $vehiculeModel->displayOne($id_vehicule);
         $avisModel = new AvisModel();
         $avis = $avisModel->displayByIdCar($id_vehicule);
         if ($vehicule) {
            $this->render('vehicule/showCarOne', ['vehicule' => $vehicule, 'avis' => $avis]);
         } else {
            $_SESSION['message'] = 'Véhicule introuvable.';
            header('Location: index.php?controller=Vehicule&action=showCar');
            exit();
         }
      } else {
         $_SESSION['message'] = 'Error';
         header('Location: index.php?controller=Vehicule&action=showCar');
         exit();
      }
   }

   public function showCarByCatégorie()
   {
      if (isset($_GET['id_categorie']) && !empty($_GET['id_categorie'])) {
         $id_categorie = $_GET['id_categorie'];
         $id_vehicule = $_GET['id_vehicule'];
         $vehiculeModel = new VehiculeModel();
         $vehicule = $vehiculeModel->displayByCategory($id_categorie);
         $avisModel = new AvisModel();
         $avis = $avisModel->displayByIdCar($id_vehicule);
         if ($vehicule) {
            $this->render('vehicule/showCarByCatégorie', ['vehicule' => $vehicule, 'avis' => $avis]);
         } else {
            $_SESSION['message'] = 'Catégorie de véhicule introuvable.';
            header('Location: index.php?controller=Vehicule&action=showCar');
            exit();
         }
      } else {
         $_SESSION['message'] = 'Error';
         header('Location: index.php?controller=Vehicule&action=showCar');
         exit();
      }
   }
}
