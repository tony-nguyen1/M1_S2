(*Exercice 1*)

Parameter A B C : Prop.

(* Question 1 *)
Goal A -> B -> A.
Proof.
  intros.
  assumption.
Qed.

(* Question 2 *)
Goal (A -> B -> C) -> (A->B)->A->C.
Proof.
  intro.
  intro.
  intro.
  apply H.
  - assumption.
  - apply H0.
  assumption.
Qed.

(* Question 3 *)
Goal A /\ B -> B.
Proof.
  intro. 
  destruct H. 
  assumption.
Qed.
(*intro. elim H. intro. intro. clear H. assumption.*)

(* Question 4 *)
Goal B->A\/B.
Proof.
  intro.
  right.
  assumption.
Qed.

(* Question 5 *)
Goal (A \/ B) -> (A -> C) -> (B -> C) -> C.
Proof.
  intros.
  destruct H.
  - apply H0.
    assumption.
  - apply (H1 H).
Qed.

(* Question 6 *)
Goal A -> False -> ~A.
Proof.
  intros.
  (* 
    Quand on a False en hypthèses, 
    on réfléchit pas. 
  *)
  elimtype False.
  assumption.
Qed.

(* Question 7 *)
Goal False -> A.
Proof.
  intro.
  elimtype False.
  assumption.
Qed.
  (*  tauto. *)

(* Question 8 *)
Goal (A <-> B) -> A -> B.
Proof.
  intros HAB HA.
  apply HAB.
  assumption.
Qed.

(* Question 9 *)
Goal (A <-> B) -> B -> A.
Proof.
  intros.
  destruct H.
  apply (H1 H0).
Qed.

(* Question 10 *)
Goal (A -> B) -> (B -> A) -> (A <-> B).
Proof.
  intro. intro.
  split.
  - assumption.
  - assumption.
Qed.