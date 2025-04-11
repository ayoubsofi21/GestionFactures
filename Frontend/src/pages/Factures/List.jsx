// src/pages/Factures/List.jsx
import React, {useState, useEffect} from "react";
import {useAuth} from "../../contexts/AuthContext";
import api from "../../api/factures";
import {
  Table,
  TableBody,
  TableCell,
  TableContainer,
  TableHead,
  TableRow,
  Paper,
  Typography,
  TextField,
  Button,
  Chip,
} from "@mui/material";

const FactureList = () => {
  const {user} = useAuth();
  const [factures, setFactures] = useState([]);
  const [loading, setLoading] = useState(true);
  const [searchTerm, setSearchTerm] = useState("");
  const [filterStatus, setFilterStatus] = useState("");

  useEffect(() => {
    const fetchFactures = async () => {
      try {
        const response = await api.getFactures();
        setFactures(response.data);
        setLoading(false);
      } catch (error) {
        console.error("Error fetching factures:", error);
        setLoading(false);
      }
    };

    fetchFactures();
  }, []);

  const filteredFactures = factures.filter((facture) => {
    const matchesSearch =
      facture.reference.toLowerCase().includes(searchTerm.toLowerCase()) ||
      facture.fournisseur.nom.toLowerCase().includes(searchTerm.toLowerCase());

    const matchesStatus = filterStatus ? facture.statut === filterStatus : true;

    return matchesSearch && matchesStatus;
  });

  const handleAutoriser = async (id) => {
    try {
      await api.autoriserFacture(id);
      setFactures(
        factures.map((f) => (f.id === id ? {...f, statut: "autorisee"} : f))
      );
    } catch (error) {
      console.error("Error autorising facture:", error);
    }
  };

  const handleHonorer = async (id) => {
    try {
      await api.honorerFacture(id);
      setFactures(
        factures.map((f) => (f.id === id ? {...f, statut: "honoree"} : f))
      );
    } catch (error) {
      console.error("Error honoring facture:", error);
    }
  };

  if (loading) return <Typography>Loading...</Typography>;

  return (
    <Paper sx={{p: 3}}>
      <Typography variant="h5" gutterBottom>
        Liste des Factures
      </Typography>

      <div style={{display: "flex", gap: "1rem", marginBottom: "1rem"}}>
        <TextField
          label="Rechercher"
          variant="outlined"
          size="small"
          value={searchTerm}
          onChange={(e) => setSearchTerm(e.target.value)}
        />

        <TextField
          select
          label="Statut"
          variant="outlined"
          size="small"
          value={filterStatus}
          onChange={(e) => setFilterStatus(e.target.value)}
          SelectProps={{native: true}}>
          <option value="">Tous</option>
          <option value="enregistree">Enregistrée</option>
          <option value="a_autoriser">À autoriser</option>
          <option value="autorisee">Autorisée</option>
          <option value="honoree">Honorée</option>
        </TextField>
      </div>

      <TableContainer component={Paper}>
        <Table>
          <TableHead>
            <TableRow>
              <TableCell>Référence</TableCell>
              <TableCell>Fournisseur</TableCell>
              <TableCell>Date</TableCell>
              <TableCell>Montant</TableCell>
              <TableCell>Statut</TableCell>
              <TableCell>Actions</TableCell>
            </TableRow>
          </TableHead>
          <TableBody>
            {filteredFactures.map((facture) => (
              <TableRow key={facture.id}>
                <TableCell>{facture.reference}</TableCell>
                <TableCell>{facture.fournisseur.nom}</TableCell>
                <TableCell>
                  {new Date(facture.date_facture).toLocaleDateString()}
                </TableCell>
                <TableCell>{facture.montant} MAD</TableCell>
                <TableCell>
                  <Chip
                    label={facture.statut}
                    color={
                      facture.statut === "honoree"
                        ? "success"
                        : facture.statut === "autorisee"
                        ? "primary"
                        : facture.statut === "a_autoriser"
                        ? "warning"
                        : "default"
                    }
                  />
                </TableCell>
                <TableCell>
                  {facture.statut === "a_autoriser" && user.autoriserf && (
                    <Button
                      size="small"
                      color="primary"
                      onClick={() => handleAutoriser(facture.id)}>
                      Autoriser
                    </Button>
                  )}

                  {facture.statut === "autorisee" && user.honorer && (
                    <Button
                      size="small"
                      color="secondary"
                      onClick={() => handleHonorer(facture.id)}>
                      Honorer
                    </Button>
                  )}
                </TableCell>
              </TableRow>
            ))}
          </TableBody>
        </Table>
      </TableContainer>
    </Paper>
  );
};

export default FactureList;
