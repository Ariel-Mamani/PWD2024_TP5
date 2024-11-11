    <!-- Separador -->
    <div class="separador"></div>

    <br>


    <!-- Separador -->
    <div class="separador"></div>

    <br>

    <div class="div_sector_productos">
        <!-- Tabla Coloracion -->
        <div>
            <!-- Titulos productos -->
            <div class="div_nombres_productos">
                <p class="titulo_tabla">Coloraci&oacute;n</p>
            </div>

            <table class="table table-hover table-striped">
                <!-- Titulos de las columnas -->
                <thead>
                    <tr class="text-light mb-4">
                        <th>Detalle</th>
                        <th>Precio</th>
                        <th class="text-center">Reservar</th>
                    </tr>
                </thead>

                <tbody>
                    <?php	
                        if(count($listaPeluqueria) > 0)
                        {
                            foreach ($listaPeluqueria as $objPeluqueria)
                            { 
                                echo '<tr><td>'.$objPeluqueria->getDetalle().'</td>';
                                echo '<td>'.$objPeluqueria->getPrecio().'</td>';
                                echo '<td class="text-center"><a href="reservar_tuno.php?NroDni='.$objPeluqueria->getLLLLLLLLLL()->getÑÑÑÑÑÑÑÑÑÑÑÑ().'" class="btn btn-outline-dark btn-sm" role="button">Reservar turno</a></td></tr>';
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Tabla Cortes y peinados -->
        <div>
            <!-- Titulos productos -->
            <div class="div_nombres_productos">
                <p class="titulo_tabla">Cortes y peinados</p>
            </div>

            <table class="table table-hover table-striped">
                <!-- Titulos de las columnas -->
                <thead>
                    <tr class="text-light mb-4">
                        <th>Detalle</th>
                        <th>Precio</th>
                        <th class="text-center">Reservar</th>
                    </tr>
                </thead>

                <tbody>
                    <?php	
                        if(count($listaPeluqueria) > 0)
                        {
                            foreach ($listaPeluqueria as $objPeluqueria)
                            { 
                                echo '<tr><td>'.$objPeluqueria->getDetalle().'</td>';
                                echo '<td>'.$objPeluqueria->getPrecio().'</td>';
                                echo '<td class="text-center"><a href="reservar_tuno.php?NroDni='.$objPeluqueria->getLLLLLLLLLL()->getÑÑÑÑÑÑÑÑÑÑÑÑ().'" class="btn btn-outline-dark btn-sm" role="button">Reservar turno</a></td></tr>';
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Tabla Promociones -->
        <div>
            <!-- Titulos productos -->
            <div class="div_nombres_productos">
                <p class="titulo_tabla">Promociones</p>
            </div>

            <table class="table table-hover table-striped">
                <!-- Titulos de las columnas -->
                <thead>
                    <tr class="text-light mb-4">
                        <th>Detalle</th>
                        <th>Precio</th>
                        <th class="text-center">Reservar</th>
                    </tr>
                </thead>

                <tbody>
                    <?php	
                        if(count($listaPeluqueria) > 0)
                        {
                            foreach ($listaPeluqueria as $objPeluqueria)
                            { 
                                echo '<tr><td>'.$objPeluqueria->getDetalle().'</td>';
                                echo '<td>'.$objPeluqueria->getPrecio().'</td>';
                                echo '<td class="text-center"><a href="reservar_tuno.php?NroDni='.$objPeluqueria->getLLLLLLLLLL()->getÑÑÑÑÑÑÑÑÑÑÑÑ().'" class="btn btn-outline-dark btn-sm" role="button">Reservar turno</a></td></tr>';
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Tabla Tratamientos -->
        <div>
            <!-- Titulos productos -->
            <div class="div_nombres_productos">
                <p class="titulo_tabla">Tratamientos</p>
            </div>

            <table class="table table-hover table-striped">
                <!-- Titulos de las columnas -->
                <thead>
                    <tr class="text-light mb-4">
                        <th>Detalle</th>
                        <th>Precio</th>
                        <th class="text-center">Reservar</th>
                    </tr>
                </thead>

                <tbody>
                    <?php	
                        if(count($listaPeluqueria) > 0)
                        {
                            foreach ($listaPeluqueria as $objPeluqueria)
                            { 
                                echo '<tr><td>'.$objPeluqueria->getDetalle().'</td>';
                                echo '<td>'.$objPeluqueria->getPrecio().'</td>';
                                echo '<td class="text-center"><a href="reservar_tuno.php?NroDni='.$objPeluqueria->getLLLLLLLLLL()->getÑÑÑÑÑÑÑÑÑÑÑÑ().'" class="btn btn-outline-dark btn-sm" role="button">Reservar turno</a></td></tr>';
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- Tabla Nuestros productos -->
        <div>
            <!-- Titulos Nuestros productos -->
            <div class="div_nombres_productos">
                <p class="titulo_tabla">Nuestros productos</p>
            </div>

            <table class="table table-hover table-striped">
                <!-- Titulos de las columnas -->
                <thead>
                    <tr class="text-light mb-4">
                        <th>Detalle</th>
                        <th>Precio</th>
                        <th class="text-center">Reservar</th>
                    </tr>
                </thead>

                <tbody>
                    <?php	
                        if(count($listaPeluqueria) > 0)
                        {
                            foreach ($listaPeluqueria as $objPeluqueria)
                            { 
                                echo '<tr><td>'.$objPeluqueria->getDetalle().'</td>';
                                echo '<td>'.$objPeluqueria->getPrecio().'</td>';
                                echo '<td class="text-center"><a href="reservar_tuno.php?NroDni='.$objPeluqueria->getLLLLLLLLLL()->getÑÑÑÑÑÑÑÑÑÑÑÑ().'" class="btn btn-outline-dark btn-sm" role="button">Reservar turno</a></td></tr>';
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>

    <br><br>
