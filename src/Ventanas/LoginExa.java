/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/GUIForms/JFrame.java to edit this template
 */
package Ventanas;

import com.devazt.networking.HttpClient;
import com.devazt.networking.OnHttpRequestComplete;
import com.devazt.networking.Response;
import javax.swing.Icon;
import javax.swing.ImageIcon;
import javax.swing.JOptionPane;
import org.json.JSONException;
import org.json.JSONObject;
/**
 *
 * @author marij
 */
public class LoginExa extends javax.swing.JFrame {

    String NameUser, Contraseña, estado;
    boolean SiEntrar=false;
    Icon EntrarAlter = new ImageIcon("C:\\Users\\marij\\OneDrive\\Documentos\\NetBeansProjects\\LoginExam\\Iconos\\EntrarAlter.png");
    Icon Entrar = new ImageIcon("C:\\Users\\marij\\OneDrive\\Documentos\\NetBeansProjects\\LoginExam\\Iconos\\Entrar.png");

    public LoginExa() {
        initComponents();
        this.setLocationRelativeTo(null);
    }

    /**
     * This method is called from within the constructor to initialize the form.
     * WARNING: Do NOT modify this code. The content of this method is always
     * regenerated by the Form Editor.
     */
    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        LbUser = new javax.swing.JLabel();
        TfUser = new javax.swing.JTextField();
        TfPassword = new javax.swing.JPasswordField();
        LbContraseña = new javax.swing.JLabel();
        LbNombre = new javax.swing.JLabel();
        LbEnter = new javax.swing.JLabel();
        LbAviso = new javax.swing.JLabel();
        LbFondo = new javax.swing.JLabel();

        setDefaultCloseOperation(javax.swing.WindowConstants.EXIT_ON_CLOSE);
        getContentPane().setLayout(new org.netbeans.lib.awtextra.AbsoluteLayout());

        LbUser.setIcon(new javax.swing.ImageIcon(getClass().getResource("/Imagenes/User.png"))); // NOI18N
        getContentPane().add(LbUser, new org.netbeans.lib.awtextra.AbsoluteConstraints(120, 60, -1, -1));

        TfUser.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                TfUserActionPerformed(evt);
            }
        });
        getContentPane().add(TfUser, new org.netbeans.lib.awtextra.AbsoluteConstraints(160, 300, 170, -1));

        TfPassword.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                TfPasswordActionPerformed(evt);
            }
        });
        getContentPane().add(TfPassword, new org.netbeans.lib.awtextra.AbsoluteConstraints(160, 340, 170, -1));

        LbContraseña.setText("Contraseña:");
        getContentPane().add(LbContraseña, new org.netbeans.lib.awtextra.AbsoluteConstraints(80, 340, -1, -1));

        LbNombre.setText("Nombre: ");
        getContentPane().add(LbNombre, new org.netbeans.lib.awtextra.AbsoluteConstraints(90, 300, -1, -1));

        LbEnter.setIcon(new javax.swing.ImageIcon(getClass().getResource("/Imagenes/Entrar.png"))); // NOI18N
        LbEnter.addMouseListener(new java.awt.event.MouseAdapter() {
            public void mouseClicked(java.awt.event.MouseEvent evt) {
                LbEnterMouseClicked(evt);
            }
            public void mousePressed(java.awt.event.MouseEvent evt) {
                LbEnterMousePressed(evt);
            }
            public void mouseReleased(java.awt.event.MouseEvent evt) {
                LbEnterMouseReleased(evt);
            }
        });
        getContentPane().add(LbEnter, new org.netbeans.lib.awtextra.AbsoluteConstraints(120, 450, -1, -1));

        LbAviso.setText("Entrar");
        getContentPane().add(LbAviso, new org.netbeans.lib.awtextra.AbsoluteConstraints(200, 660, -1, -1));

        LbFondo.setIcon(new javax.swing.ImageIcon(getClass().getResource("/Imagenes/FondoLogin.png"))); // NOI18N
        getContentPane().add(LbFondo, new org.netbeans.lib.awtextra.AbsoluteConstraints(0, 0, 450, -1));

        pack();
    }// </editor-fold>//GEN-END:initComponents

    private void TfUserActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_TfUserActionPerformed
        // TODO add your handling code here:
    }//GEN-LAST:event_TfUserActionPerformed

    private void TfPasswordActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_TfPasswordActionPerformed
        // TODO add your handling code here:
    }//GEN-LAST:event_TfPasswordActionPerformed

    private void LbEnterMouseClicked(java.awt.event.MouseEvent evt) {//GEN-FIRST:event_LbEnterMouseClicked
        HttpClient Cliente = new HttpClient(new OnHttpRequestComplete() {
            @Override
            public void onComplete(Response status) {
                if(status.isSuccess())
                {
                    try{
                        JSONObject Usuarios = new JSONObject(status.getResult());
                        String UserWeb=Usuarios.getJSONObject("0").get("NameUser").toString();
                        String ContraseñaWeb=Usuarios.getJSONObject("0").get("Contraseña").toString();
                        if(TfUser.getText().toString().equals(UserWeb) &&
                                TfPassword.getText().toString().equals(ContraseñaWeb)){
                            estado=Usuarios.getJSONObject("0").get("estado").toString();
                            LbAviso.setText("Entrando..");   
                            SiEntrar=true;
                        }
                    }
                        catch(JSONException e){
                    }
                    
                }
                    //La linea de throw de abajo causaba error por razones desconocidas(me costo 3 dias darme cuenta)
                    //throw new UnsupportedOperationException("Not supported yet."); // Generated from nbfs://nbhost/SystemFileSystem/Templates/Classes/Code/GeneratedMethodBody
            }
        });
        NameUser=TfUser.getText().toString();
        Contraseña=TfPassword.getText().toString();
        
        Cliente.excecute("http://localhost/Api/login.php?NameUser="+ NameUser+"&Contraseña="+Contraseña+"");
        
        if (SiEntrar==true){
            MenuExa ventanaMenu= new MenuExa();
            //LbEntrar.setIcon(entrarAlter);
            LbAviso.setText("Entrando..");
            ventanaMenu.estado= Integer.parseInt(this.estado);
            ventanaMenu.setVisible(true);
            ventanaMenu.setLocationRelativeTo(null);
            this.setVisible(false);
           
            if(estado.equals("1")){
                ventanaMenu.nivel1();
            }
            else if(estado.equals("2")){
                ventanaMenu.nivel2();
            }
            else if(estado.equals("3")){
                ventanaMenu.nivel3();
            }
            else{
                JOptionPane.showMessageDialog(null, "Usuario no encontrado");
            }
        }
        
        
    }//GEN-LAST:event_LbEnterMouseClicked

    private void LbEnterMousePressed(java.awt.event.MouseEvent evt) {//GEN-FIRST:event_LbEnterMousePressed
        LbEnter.setIcon(EntrarAlter);
        
    }//GEN-LAST:event_LbEnterMousePressed

    private void LbEnterMouseReleased(java.awt.event.MouseEvent evt) {//GEN-FIRST:event_LbEnterMouseReleased
        LbEnter.setIcon(Entrar);
        
    }//GEN-LAST:event_LbEnterMouseReleased

    /**
     * @param args the command line arguments
     */
    public static void main(String args[]) {
        /* Set the Nimbus look and feel */
        //<editor-fold defaultstate="collapsed" desc=" Look and feel setting code (optional) ">
        /* If Nimbus (introduced in Java SE 6) is not available, stay with the default look and feel.
         * For details see http://download.oracle.com/javase/tutorial/uiswing/lookandfeel/plaf.html 
         */
        try {
            for (javax.swing.UIManager.LookAndFeelInfo info : javax.swing.UIManager.getInstalledLookAndFeels()) {
                if ("Nimbus".equals(info.getName())) {
                    javax.swing.UIManager.setLookAndFeel(info.getClassName());
                    break;
                }
            }
        } catch (ClassNotFoundException ex) {
            java.util.logging.Logger.getLogger(LoginExa.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (InstantiationException ex) {
            java.util.logging.Logger.getLogger(LoginExa.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (IllegalAccessException ex) {
            java.util.logging.Logger.getLogger(LoginExa.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (javax.swing.UnsupportedLookAndFeelException ex) {
            java.util.logging.Logger.getLogger(LoginExa.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        }
        //</editor-fold>

        /* Create and display the form */
        java.awt.EventQueue.invokeLater(new Runnable() {
            public void run() {
                new LoginExa().setVisible(true);
            }
        });
    }

    // Variables declaration - do not modify//GEN-BEGIN:variables
    private javax.swing.JLabel LbAviso;
    private javax.swing.JLabel LbContraseña;
    private javax.swing.JLabel LbEnter;
    private javax.swing.JLabel LbFondo;
    private javax.swing.JLabel LbNombre;
    private javax.swing.JLabel LbUser;
    private javax.swing.JPasswordField TfPassword;
    private javax.swing.JTextField TfUser;
    // End of variables declaration//GEN-END:variables
}
