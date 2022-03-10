<ul id="navigation-<?= $kunci + 1 ?>">
  <?php foreach ($data['buildingList'] as $value) : ?>
    <li><input type="checkbox" name="idBuilding[]"><a href="?<?= $value['idAsset'] ?>"><?= strtoupper($value['buildingName']); ?></a>
      <?php if (sizeof($value['propAssetPropbuildingFloor']) > 0) : ?>
        <ul>
          <?php foreach ($value['propAssetPropbuildingFloor'] as $value2) : ?>
            <li><input type="checkbox" name="idFloor[]"><a href="?<?= $value2['idBuilding'] . $value2['idFloor'] ?>"><?= strtoupper($value2['floorName']); ?></a>
              <?php if (sizeof($value2['propAssetPropbuildingRoom']) > 0) : ?>
                <ul>
                  <?php foreach ($value2['propAssetPropbuildingRoom'] as $value3) : ?>
                    <li><input type="checkbox" name="idRoom[]"><a href="?<?= $value3['idBuilding'] . $value3['idFloor'] . $value3['idRoom'] ?>"><?= strtoupper($value3['roomName']); ?></a>

                    </li>
                  <?php endforeach; ?>
                </ul>
              <?php endif; ?>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </li>
  <?php endforeach; ?>

</ul>
<ul id="navigation-cat-<?= $kunci + 1 ?>">
  <?php foreach ($data['assetCatList'] as $val) : ?>
    <li><input type="checkbox"><a href="?<?= $val['catCode'] ?>"><?= strtoupper($val['assetCatName']); ?></a>
      <?php if (sizeof($val['propZAssetCatprop']) > 0) : ?>
        <ul>
          <?php foreach ($val['propZAssetCatprop'] as $val2) : ?>
            <li><input type="checkbox"><a href="?<?= $val['catCode'] . $val2['idAssetProp'] ?>"><?= strtoupper($val2['propName']); ?></a>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </li>
  <?php endforeach; ?>

</ul>
