<table>
  <thead>
    <tr>
      <th>No</th>
      <th>UnitNo</th>
      <th>ActiveDate</th>
      <th>Desc</th>
      <th>Category</th>
      <th>PlantType</th>
      <th>PlantGroup</th>
      <th>Status</th>
      <th>CurrProject</th>
      <th>SN</th>
      <th>ChasisNo</th>
      <th>EngModel</th>
      <th>MachineNo</th>
      <th>NoPol</th>
      <th>FuelType</th>
      <th>Color</th>
      <th>PIC</th>
      <th>CartFlag</th>
      <th>Capacity</th>
      <th>AssignTo</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($equipments as $equipment)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $equipment->unit_no }}</td>
          <td>{{ $equipment->active_date ? date('d-M-Y', strtotime($equipment->active_date)) : 'n/a' }}</td>
          <td>{{ $equipment->description }}</td>
          <td>{{ $equipment->asset_category->name }}</td>
          <td>{{ $equipment->plant_type->name }}</td>
          <td>{{ $equipment->plant_group->name }}</td>
          <td>{{ $equipment->unitstatus->name }}</td>
          <td>{{ $equipment->current_project->project_code }}</td>
          <td>{{ $equipment->serial_no }}</td>
          <td>{{ $equipment->chasis_no }}</td>
          <td>{{ $equipment->engine_model }}</td>
          <td>{{ $equipment->machine_no }}</td>
          <td>{{ $equipment->nomor_polisi }}</td>
          <td>{{ $equipment->bahan_bakar }}</td>
          <td>{{ $equipment->warna }}</td>
          <td>{{ $equipment->unit_pic }}</td>
          <td>{{ $equipment->cart_flag }}</td>
          <td>{{ $equipment->capacity }}</td>
          <td>{{ $equipment->assign_to }}</td>
        </tr>
    @endforeach
  </tbody>
</table>