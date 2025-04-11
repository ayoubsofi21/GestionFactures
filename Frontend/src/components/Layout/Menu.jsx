// src/components/Layout/Menu.jsx
import React from "react";
import {useAuth} from "../../contexts/AuthContext";
import {
  List,
  ListItem,
  ListItemIcon,
  ListItemText,
  Divider,
} from "@mui/material";
import {
  Receipt as FactureIcon,
  People as FournisseurIcon,
  Assignment as MarcheIcon,
  CheckCircle as AutorisationIcon,
  ListAlt as InstancesIcon,
  ExitToApp as LogoutIcon,
} from "@mui/icons-material";
import {Link} from "react-router-dom";

const Menu = () => {
  const {user, logout} = useAuth();

  return (
    <List>
      {user?.writfactur && (
        <ListItem button component={Link} to="/factures/create">
          <ListItemIcon>
            <FactureIcon />
          </ListItemIcon>
          <ListItemText primary="Enregistrer Facture" />
        </ListItem>
      )}

      {user?.consulter && (
        <ListItem button component={Link} to="/factures/list">
          <ListItemIcon>
            <FactureIcon />
          </ListItemIcon>
          <ListItemText primary="Consultation" />
        </ListItem>
      )}

      {user?.fournisseu && (
        <ListItem button component={Link} to="/fournisseurs">
          <ListItemIcon>
            <FournisseurIcon />
          </ListItemIcon>
          <ListItemText primary="Fournisseur" />
        </ListItem>
      )}

      {user?.marche && (
        <ListItem button component={Link} to="/marches">
          <ListItemIcon>
            <MarcheIcon />
          </ListItemIcon>
          <ListItemText primary="Marché" />
        </ListItem>
      )}

      {user?.autoriserf && (
        <ListItem button component={Link} to="/factures/a-autoriser">
          <ListItemIcon>
            <AutorisationIcon />
          </ListItemIcon>
          <ListItemText primary="Autorisation" />
        </ListItem>
      )}

      {user?.instances && (
        <ListItem button component={Link} to="/instances">
          <ListItemIcon>
            <InstancesIcon />
          </ListItemIcon>
          <ListItemText primary="Instances" />
        </ListItem>
      )}

      <Divider />

      <ListItem button onClick={logout}>
        <ListItemIcon>
          <LogoutIcon />
        </ListItemIcon>
        <ListItemText primary="Quitter" />
      </ListItem>
    </List>
  );
};

export default Menu;
